<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 14px;
        }

        .title {
            text-align: center;
            margin-bottom: 14px;
        }

        .title h1 {
            margin: 0;
            font-size: 17px;
        }

        .title p {
            margin: 4px 0 0;
            font-size: 10px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.meta {
            margin-bottom: 12px;
        }

        table.meta td {
            padding: 4px 3px;
            vertical-align: top;
        }

        table.meta td.label {
            width: 22%;
            color: #374151;
        }

        table.meta td.separator {
            width: 2%;
        }

        .status {
            margin: 10px 0 12px;
            padding: 7px 8px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
        }

        .status .ok {
            color: #15803d;
            font-weight: 700;
        }

        .status .bad {
            color: #b91c1c;
            font-weight: 700;
        }

        table.report th,
        table.report td {
            border: 1px solid #d1d5db;
            padding: 7px;
        }

        table.report th {
            background: #f3f4f6;
            text-align: center;
        }

        td.right {
            text-align: right;
        }

        .text-danger {
            color: #dc2626;
            font-weight: 700;
        }

        .text-success {
            color: #16a34a;
            font-weight: 700;
        }

        .notes {
            margin-top: 12px;
            padding: 8px;
            border: 1px solid #d1d5db;
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>Lembar Evaluasi PAK</h1>
        <p>Ringkasan perbandingan angka kredit untuk evaluasi jabatan fungsional</p>
    </div>

    <table class="meta">
        <tr>
            <td class="label"><strong>Nama</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->nama_saat_pak ?? $pakHistory->pegawai?->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label"><strong>NIP</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->nip }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Jabatan</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->jf_saat_pak ?? $pakHistory->pegawai?->jf ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Golongan</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->gol_saat_pak ?? $pakHistory->pegawai?->gol ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Unit Kerja</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->uk_saat_pak ?? $pakHistory->pegawai?->uk ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Periode Tahun</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->periode_tahun ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Tanggal PAK</strong></td>
            <td class="separator">:</td>
            <td>{{ $pakHistory->tanggal_pak ? $pakHistory->tanggal_pak->format('d-m-Y') : '-' }}</td>
        </tr>
    </table>

    <div class="status">
        <strong>Status Evaluasi:</strong>
        @if($pakHistory->status_evaluasi === 'Terpenuhi')
            <span class="ok">{{ $pakHistory->status_evaluasi }}</span>
        @else
            <span class="bad">{{ $pakHistory->status_evaluasi }}</span>
        @endif
    </div>

    <table class="report">
        <thead>
            <tr>
                <th>Uraian</th>
                <th>Nilai (Aktual / Dasar)</th>
                <th>Selisih</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>AK Baru vs AK Dasar KP</td>
                <td class="right">{{ number_format((float) $pakHistory->ak_baru, 2, ',', '.') }} / {{ number_format((float) $pakHistory->ak_dasar_kp, 2, ',', '.') }}</td>
                <td class="right {{ $pakHistory->selisih_kp < 0 ? 'text-danger' : 'text-success' }}">
                    {{ $pakHistory->selisih_kp > 0 ? '+' : '' }}{{ number_format($pakHistory->selisih_kp, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>Jumlah AK vs AK Dasar Jenjang</td>
                <td class="right">{{ number_format((float) $pakHistory->jumlah_ak, 2, ',', '.') }} / {{ number_format((float) $pakHistory->ak_dasar_jenjang, 2, ',', '.') }}</td>
                <td class="right {{ $pakHistory->selisih_jenjang < 0 ? 'text-danger' : 'text-success' }}">
                    {{ $pakHistory->selisih_jenjang > 0 ? '+' : '' }}{{ number_format($pakHistory->selisih_jenjang, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    @if($pakHistory->keterangan)
        <div class="notes">
            <strong>Keterangan:</strong> {{ $pakHistory->keterangan }}
        </div>
    @endif
</body>
</html>