<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiRekapExport;
use App\Models\MasterGolongan;
use App\Models\MasterJf;
use App\Models\MasterUnitKerja;
use App\Models\PakHistory;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PakHistoryController extends Controller
{
    public function history(string $nip)
    {
        $pegawai = Pegawai::query()
            ->with(['pakHistories' => function ($query) {
                $query
                    ->orderByDesc('periode_tahun')
                    ->orderByDesc('tanggal_pak')
                    ->orderByDesc('id');
            }])
            ->where('nip', $nip)
            ->firstOrFail();

        $latestHistory = $pegawai->pakHistories->first();
        $nextYear = $latestHistory?->periode_tahun ? ($latestHistory->periode_tahun + 1) : now()->year;

        return view('pak_history.index', [
            'pegawai' => $pegawai,
            'histories' => $pegawai->pakHistories,
            'latestHistory' => $latestHistory,
            'nextYear' => $nextYear,
        ]);
    }

    public function generateNextDraft(string $nip): RedirectResponse
    {
        $pegawai = Pegawai::query()->with(['pakHistories' => function ($query) {
            $query
                ->orderByDesc('periode_tahun')
                ->orderByDesc('tanggal_pak')
                ->orderByDesc('id');
        }])->where('nip', $nip)->firstOrFail();

        $latest = $pegawai->pakHistories->first();

        if (! $latest) {
            return redirect()
                ->route('pak-histories.history', $nip)
                ->with('success', 'Belum ada riwayat untuk dijadikan draft. Silakan input data awal terlebih dahulu.');
        }

        $nextYear = ((int) $latest->periode_tahun) + 1;

        $exists = PakHistory::query()
            ->where('nip', $nip)
            ->where('periode_tahun', $nextYear)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('pak-histories.history', $nip)
                ->with('success', 'Draft/riwayat untuk periode ' . $nextYear . ' sudah ada.');
        }

        PakHistory::create([
            'nip' => $nip,
            'periode_tahun' => $nextYear,
            'tanggal_pak' => $latest->tanggal_pak
                ? $latest->tanggal_pak->copy()->setYear($nextYear)->toDateString()
                : now()->setYear($nextYear)->toDateString(),
            'input_status' => 'draft',
            'nama_saat_pak' => $pegawai->nama,
            'jf_saat_pak' => $pegawai->jf,
            'gol_saat_pak' => $pegawai->gol,
            'uk_saat_pak' => $pegawai->uk,
            'no_pak' => 'DRAFT/' . $nip . '/' . $nextYear,
            'ak_baru' => $latest->jumlah_ak,
            'ak_dasar_kp' => $latest->ak_dasar_kp,
            'ak_dasar_jenjang' => $latest->ak_dasar_jenjang,
            'jumlah_ak' => $latest->jumlah_ak,
            'keterangan' => 'Draft otomatis periode ' . $nextYear,
        ]);

        return redirect()
            ->route('pak-histories.history', $nip)
            ->with('success', 'Draft periode ' . $nextYear . ' berhasil dibuat.');
    }

    public function edit(PakHistory $pakHistory)
    {
        $pakHistory->load('pegawai');

        return view('pak_history.edit', [
            'pakHistory' => $pakHistory,
        ]);
    }

    public function update(Request $request, PakHistory $pakHistory): RedirectResponse
    {
        $validated = $request->validate([
            'nama_saat_pak' => ['required', 'string', 'max:255'],
            'jf_saat_pak' => ['required', 'string', 'max:255'],
            'gol_saat_pak' => ['required', 'string', 'max:50'],
            'uk_saat_pak' => ['required', 'string', 'max:100'],
            'periode_tahun' => [
                'required',
                'integer',
                'digits:4',
                'between:1900,2100',
                Rule::unique('pak_history', 'periode_tahun')
                    ->where(fn($query) => $query->where('nip', $pakHistory->nip))
                    ->ignore($pakHistory->id),
            ],
            'tanggal_pak' => ['required', 'date'],
            'no_pak' => ['required', 'string', 'max:100'],
            'ak_baru' => ['required', 'numeric'],
            'ak_dasar_kp' => ['required', 'numeric'],
            'ak_dasar_jenjang' => ['required', 'numeric'],
            'jumlah_ak' => ['required', 'numeric'],
            'input_status' => ['required', 'in:draft,final'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $pakHistory->update($validated);

        if ($validated['input_status'] === 'final') {
            Pegawai::query()->where('nip', $pakHistory->nip)->update([
                'nama' => $validated['nama_saat_pak'],
                'jf' => $validated['jf_saat_pak'],
                'gol' => $validated['gol_saat_pak'],
                'uk' => $validated['uk_saat_pak'],
            ]);
        }

        return redirect()
            ->route('pak-histories.history', $pakHistory->nip)
            ->with('success', 'Data riwayat PAK berhasil diperbarui.');
    }

    public function finalize(PakHistory $pakHistory): RedirectResponse
    {
        $pakHistory->update(['input_status' => 'final']);

        Pegawai::query()->where('nip', $pakHistory->nip)->update([
            'nama' => $pakHistory->nama_saat_pak,
            'jf' => $pakHistory->jf_saat_pak,
            'gol' => $pakHistory->gol_saat_pak,
            'uk' => $pakHistory->uk_saat_pak,
        ]);

        return redirect()
            ->route('pak-histories.history', $pakHistory->nip)
            ->with('success', 'Draft berhasil difinalisasi.');
    }

    public function create(Request $request)
    {
        $selectedUk = $request->query('uk');
        $filterGol = $request->query('filter_gol');
        $filterUk = $request->query('filter_uk', $selectedUk);
        $selectedPegawaiNip = $request->query('pegawai_nip');

        $golonganOptions = collect();
        $jfOptions = collect();
        $unitKerjaOptions = collect();
        $filteredPegawai = collect();
        $selectedPegawai = null;

        if (Schema::hasTable('pegawai')) {
            $golonganOptions = $this->golonganOptions();
            $jfOptions = $this->jfOptions();
            $unitKerjaOptions = $this->unitKerjaOptions();

            $filteredPegawai = Pegawai::query()
                ->when($filterGol, fn($query) => $query->where('gol', $filterGol))
                ->when($filterUk, fn($query) => $query->where('uk', $filterUk))
                ->orderBy('nama')
                ->limit(100)
                ->get();

            if ($selectedPegawaiNip) {
                $selectedPegawai = Pegawai::query()->where('nip', $selectedPegawaiNip)->first();
            }
        }

        return view('pak_history.create', [
            'selectedUk' => $selectedUk,
            'filterGol' => $filterGol,
            'filterUk' => $filterUk,
            'selectedPegawaiNip' => $selectedPegawaiNip,
            'selectedPegawai' => $selectedPegawai,
            'golonganOptions' => $golonganOptions,
            'jfOptions' => $jfOptions,
            'unitKerjaOptions' => $unitKerjaOptions,
            'filteredPegawai' => $filteredPegawai,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:255'],
            'jf' => ['required', 'string', 'max:255'],
            'gol' => ['required', 'string', 'max:50'],
            'uk' => ['required', 'string', 'max:100'],
            'periode_tahun' => [
                'required',
                'integer',
                'digits:4',
                'between:1900,2100',
                Rule::unique('pak_history', 'periode_tahun')
                    ->where(fn($query) => $query->where('nip', $request->input('nip'))),
            ],
            'tanggal_pak' => ['required', 'date'],
            'input_status' => ['required', 'in:draft,final'],
            'no_pak' => ['required', 'string', 'max:100'],
            'ak_baru' => ['required', 'numeric'],
            'ak_dasar_kp' => ['required', 'numeric'],
            'ak_dasar_jenjang' => ['required', 'numeric'],
            'jumlah_ak' => ['required', 'numeric'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        Pegawai::updateOrCreate(
            ['nip' => $validated['nip']],
            [
                'nama' => $validated['nama'],
                'jf' => $validated['jf'],
                'gol' => $validated['gol'],
                'uk' => $validated['uk'],
            ]
        );

        PakHistory::create([
            'nip' => $validated['nip'],
            'periode_tahun' => $validated['periode_tahun'],
            'tanggal_pak' => $validated['tanggal_pak'],
            'input_status' => $validated['input_status'],
            'nama_saat_pak' => $validated['nama'],
            'jf_saat_pak' => $validated['jf'],
            'gol_saat_pak' => $validated['gol'],
            'uk_saat_pak' => $validated['uk'],
            'no_pak' => $validated['no_pak'],
            'ak_baru' => $validated['ak_baru'],
            'ak_dasar_kp' => $validated['ak_dasar_kp'],
            'ak_dasar_jenjang' => $validated['ak_dasar_jenjang'],
            'jumlah_ak' => $validated['jumlah_ak'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()
            ->route('dashboard', ['uk' => $validated['uk']])
            ->with('success', 'Data PAK berhasil disimpan sebagai ' . strtoupper($validated['input_status']) . '.');
    }

    public function exportExcel(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'uk' => $request->query('uk'),
            'gol' => $request->query('gol'),
            'jf' => $request->query('jf'),
        ];

        if (! Schema::hasTable('pegawai')) {
            return redirect()
                ->route('pegawai.index', array_filter($filters, fn($value) => $value !== null && $value !== ''))
                ->with('success', 'Tabel pegawai belum tersedia. Jalankan migrasi database terlebih dahulu.');
        }

        return Excel::download(
            new PegawaiRekapExport($filters),
            'rekap-pak-' . now()->format('Ymd-His') . '.xlsx'
        );
    }

    public function exportPdfRekap(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'uk' => $request->query('uk'),
            'gol' => $request->query('gol'),
            'jf' => $request->query('jf'),
        ];

        if (! Schema::hasTable('pegawai')) {
            return redirect()
                ->route('pegawai.index', array_filter($filters, fn($value) => $value !== null && $value !== ''))
                ->with('success', 'Tabel pegawai belum tersedia. Jalankan migrasi database terlebih dahulu.');
        }

        $pegawaiList = Pegawai::query()
            ->with('latestPakHistory')
            ->whereHas('latestPakHistory', fn($query) => $query->where('input_status', 'final'))
            ->when(! empty($filters['q']), function ($query) use ($filters) {
                $query->where(function ($subQuery) use ($filters) {
                    $subQuery
                        ->where('nip', 'like', '%' . $filters['q'] . '%')
                        ->orWhere('nama', 'like', '%' . $filters['q'] . '%');
                });
            })
            ->when(! empty($filters['uk']), fn($query) => $query->where('uk', $filters['uk']))
            ->when(! empty($filters['gol']), fn($query) => $query->where('gol', $filters['gol']))
            ->when(! empty($filters['jf']), fn($query) => $query->where('jf', $filters['jf']))
            ->orderBy('nama')
            ->get();

        $pdf = Pdf::loadView('pak_history.rekap_pdf', [
            'pegawaiList' => $pegawaiList,
            'filters' => $filters,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('rekap-pak-' . now()->format('Ymd-His') . '.pdf');
    }

    public function exportPdf(PakHistory $pakHistory)
    {
        $pakHistory->load('pegawai');

        $pdf = Pdf::loadView('pak_history.pdf', [
            'pakHistory' => $pakHistory,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('lembar-evaluasi-pak-' . $pakHistory->nip . '.pdf');
    }

    private function golonganOptions()
    {
        if (Schema::hasTable('master_golongan')) {
            return MasterGolongan::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('gol')
            ->where('gol', '!=', '')
            ->select('gol')
            ->distinct()
            ->orderBy('gol')
            ->pluck('gol');
    }

    private function jfOptions()
    {
        if (Schema::hasTable('master_jf')) {
            return MasterJf::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('jf')
            ->where('jf', '!=', '')
            ->select('jf')
            ->distinct()
            ->orderBy('jf')
            ->pluck('jf');
    }

    private function unitKerjaOptions()
    {
        if (Schema::hasTable('master_unit_kerja')) {
            return MasterUnitKerja::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('uk')
            ->where('uk', '!=', '')
            ->select('uk')
            ->distinct()
            ->orderBy('uk')
            ->pluck('uk');
    }
}
