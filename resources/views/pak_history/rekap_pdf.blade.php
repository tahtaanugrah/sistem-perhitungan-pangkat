<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1f2937;
            margin: 12px;
        }

        .title {
            margin-bottom: 10px;
        }

        .title h1 {
            margin: 0;
            font-size: 15px;
        }

        .title p {
            margin: 3px 0 0;
            color: #4b5563;
        }

        .filters {
            margin-bottom: 10px;
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
        }

        .filters span {
            margin-right: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 5px;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            text-align: center;
            font-size: 9.5px;
        }

        td.center {
            text-align: center;
        }

        td.right {
            text-align: right;
        }

        .ok {
            color: #15803d;
            font-weight: 700;
        }

        .bad {
            color: #b91c1c;
            font-weight: 700;
        }

        .muted {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>Rekap PAK Pegawai</h1>
        <p>Dicetak pada {{ $generatedAt->format('d-m-Y H:i') }}</p>
    </div>

    <div class="filters">
        <span><strong>Kata Kunci:</strong> {{ $filters['q'] !== '' ? $filters['q'] : '-' }}</span>
        <span><strong>Unit Kerja:</strong> {{ $filters['uk'] ?: '-' }}</span>
        <span><strong>Gol:</strong> {{ $filters['gol'] ?: '-' }}</span>
        <span><strong>JF:</strong> {{ $filters['jf'] ?: '-' }}</span>
        <span><strong>Total Data:</strong> {{ number_format($pegawaiList->count()) }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 10%;">NIP</th>
                <th style="width: 16%;">Nama</th>
                <th style="width: 13%;">JF</th>
                <th style="width: 7%;">Gol</th>
                <th style="width: 7%;">UK</th>
                <th style="width: 7%;">Periode</th>
                <th style="width: 8%;">Tanggal PAK</th>
                <th style="width: 7%;">Status Input</th>
                <th style="width: 9%;">No PAK</th>
                <th style="width: 6%;">AK Baru</th>
                <th style="width: 6%;">Jumlah AK</th>
                <th style="width: 8%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawaiList as $pegawai)
                @php($history = $pegawai->latestPakHistory)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->jf }}</td>
                    <td class="center">{{ $pegawai->gol }}</td>
                    <td class="center">{{ $pegawai->uk }}</td>
                    <td class="center">{{ $history?->periode_tahun ?? '-' }}</td>
                    <td class="center">{{ $history?->tanggal_pak ? $history->tanggal_pak->format('d-m-Y') : '-' }}</td>
                    <td class="center">{{ strtoupper($history?->input_status ?? 'final') }}</td>
                    <td>{{ $history?->no_pak ?? '-' }}</td>
                    <td class="right">{{ $history?->ak_baru !== null ? number_format((float) $history->ak_baru, 2, ',', '.') : '-' }}</td>
                    <td class="right">{{ $history?->jumlah_ak !== null ? number_format((float) $history->jumlah_ak, 2, ',', '.') : '-' }}</td>
                    <td class="center {{ ($history?->status_evaluasi ?? '') === 'Terpenuhi' ? 'ok' : 'bad' }}">{{ $history?->status_evaluasi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="center muted">Tidak ada data untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
