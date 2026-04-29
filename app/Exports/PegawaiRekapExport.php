<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PegawaiRekapExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles, WithEvents
{
    public function __construct(protected array $filters = []) {}

    public function collection(): Collection
    {
        if (! Schema::hasTable('pegawai')) {
            return collect();
        }

        return Pegawai::query()
            ->with('latestPakHistory')
            ->whereHas('latestPakHistory', fn($query) => $query->where('input_status', 'final'))
            ->when(! empty($this->filters['q']), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->where('nip', 'like', '%' . $this->filters['q'] . '%')
                        ->orWhere('nama', 'like', '%' . $this->filters['q'] . '%');
                });
            })
            ->when(! empty($this->filters['uk']), fn($query) => $query->where('uk', $this->filters['uk']))
            ->when(! empty($this->filters['gol']), fn($query) => $query->where('gol', $this->filters['gol']))
            ->when(! empty($this->filters['jf']), fn($query) => $query->where('jf', $this->filters['jf']))
            ->orderBy('nama')
            ->get();
    }

    public function map($pegawai): array
    {
        $pakHistory = $pegawai->latestPakHistory;

        return [
            $pegawai->nip,
            $pegawai->nama,
            $pegawai->jf,
            $pegawai->gol,
            $pegawai->uk,
            $pakHistory?->periode_tahun,
            $pakHistory?->tanggal_pak ? $pakHistory->tanggal_pak->format('d-m-Y') : '-',
            strtoupper($pakHistory?->input_status ?? 'final'),
            $pakHistory?->no_pak,
            $this->formatNumber($pakHistory?->ak_baru),
            $this->formatNumber($pakHistory?->ak_dasar_kp),
            $this->formatSignedNumber($pakHistory?->selisih_kp),
            $this->formatNumber($pakHistory?->ak_dasar_jenjang),
            $this->formatNumber($pakHistory?->jumlah_ak),
            $this->formatSignedNumber($pakHistory?->selisih_jenjang),
            $pakHistory?->status_evaluasi,
        ];
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'JF',
            'Gol',
            'UK',
            'Periode Tahun',
            'Tanggal PAK',
            'Status Input',
            'No PAK',
            'AK Baru',
            'AK Dasar KP',
            'Selisih KP',
            'AK Dasar Jenjang',
            'Jumlah AK',
            'Selisih Jenjang',
            'Status',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 28,
            'C' => 28,
            'D' => 12,
            'E' => 12,
            'F' => 13,
            'G' => 14,
            'H' => 14,
            'I' => 20,
            'J' => 13,
            'K' => 13,
            'L' => 13,
            'M' => 15,
            'N' => 13,
            'O' => 15,
            'P' => 16,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2F8F46'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $range = 'A1:P' . $lastRow;

                $sheet->freezePane('A2');
                $sheet->setAutoFilter('A1:P1');
                $sheet->getRowDimension(1)->setRowHeight(24);

                $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('A2:P' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                $sheet->getStyle('F2:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('J2:O' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                for ($row = 2; $row <= $lastRow; $row++) {
                    if ($row % 2 === 0) {
                        $sheet->getStyle('A' . $row . ':P' . $row)->getFill()->setFillType(Fill::FILL_SOLID);
                        $sheet->getStyle('A' . $row . ':P' . $row)->getFill()->getStartColor()->setRGB('F7FAF7');
                    }
                }
            },
        ];
    }

    private function formatNumber(?float $value): string
    {
        return $value === null ? '-' : number_format($value, 2, ',', '.');
    }

    private function formatSignedNumber(?float $value): string
    {
        if ($value === null) {
            return '-';
        }

        return ($value > 0 ? '+' : '') . number_format($value, 2, ',', '.');
    }
}
