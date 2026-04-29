@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $pegawaiCount = (int) ($summary['pegawaiCount'] ?? 0);
        $pakCount = (int) ($summary['pakCount'] ?? 0);
        $draftCount = (int) ($summary['draftCount'] ?? 0);
        $finalCount = (int) ($summary['finalCount'] ?? 0);
        $unitKerjaCount = (int) ($summary['unitKerjaCount'] ?? 0);
        $latestPeriod = $summary['latestPeriod'] ?? null;

        $finalRate = $pakCount > 0 ? round(($finalCount / $pakCount) * 100) : 0;
        $pakPerPegawai = $pegawaiCount > 0 ? round($pakCount / $pegawaiCount, 1) : 0;
        $statusTone = $finalRate >= 80 ? 'success' : ($finalRate >= 50 ? 'warning' : 'danger');
        $statusLabel = $finalRate >= 80 ? 'Baik' : ($finalRate >= 50 ? 'Perlu Tindak Lanjut' : 'Prioritas');
    @endphp

    <style>
        .dashboard-wrap {
            width: 100%;
        }

        .dashboard-header {
            border: 1px solid #e2eadf;
            border-radius: 16px;
            background: #ffffff;
            padding: 1rem 1.1rem;
        }

        .dashboard-header h1 {
            font-size: 1.45rem;
            margin-bottom: 0.35rem;
        }

        .dashboard-header p {
            margin-bottom: 0;
            color: #64748b;
        }

        .dashboard-meta {
            display: inline-flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 0.6rem;
        }

        .kpi-card {
            border: 1px solid #e2eadf !important;
            border-radius: 14px !important;
            box-shadow: none !important;
            height: 100%;
        }

        .kpi-card .card-body {
            padding: 0.9rem 0.95rem;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .kpi-label {
            font-size: 0.78rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .kpi-value {
            font-size: 1.45rem;
            line-height: 1;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .kpi-note {
            font-size: 0.82rem;
            color: #64748b;
            margin-bottom: 0;
        }

        .kpi-status-badge {
            display: inline-block;
            width: fit-content;
            max-width: 100%;
            white-space: normal;
            line-height: 1.2;
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .table-panel {
            border: 1px solid #e2eadf;
            border-radius: 16px;
            background: #fff;
            box-shadow: none !important;
        }

        .progress-slim {
            height: 8px;
            border-radius: 999px;
            background: #e8efe5;
            overflow: hidden;
            margin-top: 0.45rem;
        }

        .progress-slim .progress-bar {
            border-radius: 999px;
        }

        .table-panel .table-responsive {
            border-radius: 16px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table .cell-title {
            font-weight: 700;
            color: #0f172a;
            display: block;
            line-height: 1.2;
        }

        .table .cell-sub {
            color: #64748b;
            font-size: 0.78rem;
        }

        .dashboard-wrap .btn {
            min-height: 44px;
            padding-top: 0.58rem;
            padding-bottom: 0.58rem;
        }

        .dashboard-wrap .badge {
            font-size: 0.72rem;
        }

        @media (max-width: 991.98px) {
            .dashboard-header h1 {
                font-size: 1.3rem;
            }

            .kpi-card .card-body,
            .table-panel .card-body {
                padding: 0.95rem;
            }

            .kpi-value {
                font-size: 1.35rem;
            }
        }
    </style>

    <div class="dashboard-wrap">
        <div class="dashboard-header mb-4">
            <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                <div>
                    <h1>Dashboard Monitoring PAK</h1>
                    <p>Ringkasan data utama dan aktivitas terbaru.</p>
                    <div class="dashboard-meta">
                        <span class="badge badge-light">Periode: {{ $latestPeriod ? 'Tahun ' . $latestPeriod : 'Belum Ada' }}</span>
                        <span class="badge badge-{{ $statusTone }}">Finalisasi: {{ $finalRate }}% ({{ $statusLabel }})</span>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-outline-primary">Daftar Pegawai</a>
                    <a href="{{ route('pak-histories.create') }}" class="btn btn-primary">Input PAK Baru</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mb-3 align-items-stretch">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card kpi-card h-100">
                    <div class="card-body">
                        <p class="kpi-label">Total Pegawai</p>
                        <p class="kpi-value">{{ number_format($pegawaiCount) }}</p>
                        <p class="kpi-note mb-0">Pegawai aktif yang terdaftar di sistem.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card kpi-card h-100">
                    <div class="card-body">
                        <p class="kpi-label">Total Riwayat PAK</p>
                        <p class="kpi-value">{{ number_format($pakCount) }}</p>
                        <p class="kpi-note mb-0">Semua riwayat PAK yang sudah diinput.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card kpi-card h-100">
                    <div class="card-body">
                        <p class="kpi-label mb-1">Progres Finalisasi</p>
                        <span class="badge badge-{{ $statusTone }} kpi-status-badge">{{ $statusLabel }}</span>
                        <p class="kpi-value mt-1">{{ $finalRate }}%</p>
                        <p class="kpi-note mb-0">Final {{ number_format($finalCount) }} data dan Draft {{ number_format($draftCount) }} data.</p>
                        <div class="progress-slim">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $finalRate }}%" aria-valuenow="{{ $finalRate }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card kpi-card h-100">
                    <div class="card-body">
                        <p class="kpi-label">Rata-rata PAK per Pegawai</p>
                        <p class="kpi-value">{{ number_format($pakPerPegawai, 1, ',', '.') }}</p>
                        <p class="kpi-note mb-1">Rata-rata riwayat PAK per pegawai.</p>
                        <small class="text-muted mt-auto">Unit kerja terdata: {{ number_format($unitKerjaCount) }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-panel">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="mb-1">Aktivitas PAK Terbaru</h5>
                                <p class="text-muted mb-0">5 data terbaru untuk pemantauan cepat.</p>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Periode</th>
                                        <th>Status Input</th>
                                        <th>Status Evaluasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentPakHistories as $pakHistory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pakHistory->nip }}</td>
                                            <td>
                                                <span class="cell-title">{{ $pakHistory->pegawai?->nama ?? $pakHistory->nama_saat_pak }}</span>
                                                <span class="cell-sub">{{ $pakHistory->uk_saat_pak ?? $pakHistory->pegawai?->uk ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <span class="cell-title">{{ $pakHistory->periode_tahun ?? '-' }}</span>
                                                <span class="cell-sub">{{ $pakHistory->tanggal_pak ? $pakHistory->tanggal_pak->format('d-m-Y') : '-' }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ ($pakHistory->input_status ?? 'final') === 'draft' ? 'warning' : 'success' }}">
                                                    {{ strtoupper($pakHistory->input_status ?? 'final') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $pakHistory->status_evaluasi === 'Terpenuhi' ? 'success' : 'danger' }}">
                                                    {{ $pakHistory->status_evaluasi }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="{{ route('pak-histories.history', $pakHistory->nip) }}" class="btn btn-sm btn-outline-primary">Riwayat</a>
                                                    <a href="{{ route('pak-histories.pdf', $pakHistory) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada data PAK terbaru.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection