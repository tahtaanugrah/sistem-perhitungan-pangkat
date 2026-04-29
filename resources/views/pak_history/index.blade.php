@extends('layouts.app')

@section('title', 'Riwayat PAK Pegawai')

@section('content')
    <style>
        .pak-hero-panel {
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            border: 1px solid #dbe7d8;
            background: linear-gradient(135deg, #f9fdf8 0%, #f1f8ee 58%, #eef6eb 100%);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.04);
            padding: 1.15rem 1.2rem;
        }

        .pak-hero-panel::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            right: -70px;
            top: -90px;
            background: radial-gradient(circle, rgba(47, 143, 70, 0.16) 0%, rgba(47, 143, 70, 0) 70%);
            pointer-events: none;
        }

        .pak-hero {
            position: relative;
            z-index: 1;
            margin-bottom: 0;
        }

        .pak-hero-title {
            margin: 0;
            font-size: 2.05rem;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: #0f172a;
        }

        .pak-hero-subtitle {
            margin: 0.45rem 0 0;
            color: #5b687f;
            font-size: 1rem;
        }

        .pak-hero-subtitle strong {
            color: #2f8f46;
            font-weight: 700;
        }

        .pak-meta-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            margin-top: 0.85rem;
        }

        .pak-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.32rem 0.72rem;
            border-radius: 999px;
            border: 1px solid #cfe0ca;
            background: #ffffff;
            color: #35506f;
            font-size: 0.79rem;
            font-weight: 700;
            line-height: 1;
        }

        .pak-chip strong {
            color: #1f7a36;
            font-weight: 800;
        }

        .pak-chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #2f8f46;
        }

        .pak-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            min-height: 43px;
            padding: 0.5rem 1rem;
            font-weight: 700;
        }

        .pak-actions .btn svg {
            width: 14px;
            height: 14px;
            flex: 0 0 auto;
        }

        .pegawai-quick-info {
            border-radius: 24px;
            border: 1px solid #dbe5d8;
            background: linear-gradient(180deg, #fcfefb 0%, #f8fbf7 100%);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
            padding: 1.2rem;
        }

        .pegawai-info-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.8rem;
        }

        .pegawai-info-item {
            position: relative;
            background: #ffffff;
            border: 1px solid #e3eadf;
            border-radius: 16px;
            padding: 0.78rem 0.9rem 0.82rem;
            min-height: 84px;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .pegawai-info-item:hover {
            transform: translateY(-2px);
            border-color: #cfe0ca;
            box-shadow: 0 8px 18px rgba(47, 143, 70, 0.09);
        }

        .pegawai-info-item::before {
            content: "";
            position: absolute;
            left: 12px;
            right: 12px;
            top: 0;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, #2f8f46 0%, #72bf84 100%);
            opacity: 0.9;
        }

        .pegawai-info-head {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            margin-bottom: 0.35rem;
        }

        .pegawai-info-icon {
            width: 24px;
            height: 24px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(47, 143, 70, 0.12);
            color: #1f7a36;
            font-size: 0.73rem;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .pegawai-info-label {
            display: block;
            font-size: 0.73rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 0.4rem;
        }

        .pegawai-info-value {
            margin: 0;
            color: #0f172a;
            font-size: 1.04rem;
            font-weight: 700;
            line-height: 1.3;
            word-break: break-word;
        }

        @media (max-width: 1199.98px) {
            .pegawai-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .pak-hero-panel {
                border-radius: 20px;
                padding: 0.95rem;
            }

            .pak-hero-title {
                font-size: 1.55rem;
            }

            .pak-hero-subtitle {
                font-size: 0.95rem;
            }

            .pak-meta-chips {
                margin-top: 0.7rem;
                gap: 0.45rem;
            }

            .pak-chip {
                font-size: 0.74rem;
            }

            .pegawai-quick-info {
                border-radius: 18px;
                padding: 0.95rem;
            }

            .pegawai-info-grid {
                grid-template-columns: 1fr;
                gap: 0.65rem;
            }

            .pegawai-info-item {
                min-height: auto;
            }
        }
    </style>

    <div class="pak-hero-panel mb-4">
        <div class="pak-hero d-flex flex-wrap align-items-start justify-content-between gap-3">
            <div>
                <h1 class="pak-hero-title">Riwayat PAK Pegawai</h1>
                <p class="pak-hero-subtitle">
                    Data atas nama <strong>{{ $pegawai->nama }}</strong> ({{ $pegawai->nip }})
                </p>
                <div class="pak-meta-chips">
                    <span class="pak-chip">
                        <span class="pak-chip-dot"></span>
                        Draft berikutnya <strong>{{ $nextYear }}</strong>
                    </span>
                    <span class="pak-chip">
                        <span class="pak-chip-dot"></span>
                        Total riwayat <strong>{{ $histories->count() }}</strong>
                    </span>
                </div>
            </div>
            <div class="action-buttons pak-actions">
                <form method="POST" action="{{ route('pak-histories.generate-next-draft', $pegawai->nip) }}">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Buat Draft {{ $nextYear }}
                    </button>
                </form>
                <a href="{{ route('dashboard', ['uk' => $pegawai->uk]) }}" class="btn btn-light">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="pegawai-quick-info mb-4">
        <div class="pegawai-info-grid">
            <div class="pegawai-info-item">
                <div class="pegawai-info-head">
                    <span class="pegawai-info-icon">ID</span>
                    <span class="pegawai-info-label">NIP</span>
                </div>
                <p class="pegawai-info-value">{{ $pegawai->nip }}</p>
            </div>
            <div class="pegawai-info-item">
                <div class="pegawai-info-head">
                    <span class="pegawai-info-icon">NM</span>
                    <span class="pegawai-info-label">Nama</span>
                </div>
                <p class="pegawai-info-value">{{ $pegawai->nama }}</p>
            </div>
            <div class="pegawai-info-item">
                <div class="pegawai-info-head">
                    <span class="pegawai-info-icon">JF</span>
                    <span class="pegawai-info-label">Jabatan Fungsional</span>
                </div>
                <p class="pegawai-info-value">{{ $pegawai->jf }}</p>
            </div>
            <div class="pegawai-info-item">
                <div class="pegawai-info-head">
                    <span class="pegawai-info-icon">UK</span>
                    <span class="pegawai-info-label">Golongan / Unit Kerja</span>
                </div>
                <p class="pegawai-info-value">{{ $pegawai->gol }} / {{ $pegawai->uk }}</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Tanggal PAK</th>
                        <th>Status Input</th>
                        <th>Nama</th>
                        <th>JF</th>
                        <th>Gol/UK</th>
                        <th>No PAK</th>
                        <th>AK Baru</th>
                        <th>AK Dasar KP</th>
                        <th>Selisih KP</th>
                        <th>AK Dasar Jenjang</th>
                        <th>Jumlah AK</th>
                        <th>Selisih Jenjang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $history)
                        <tr>
                            <td>{{ $history->periode_tahun ?? '-' }}</td>
                            <td>{{ $history->tanggal_pak ? $history->tanggal_pak->format('d-m-Y') : '-' }}</td>
                            <td>
                                <span class="badge badge-{{ ($history->input_status ?? 'final') === 'draft' ? 'warning' : 'success' }}">
                                    {{ strtoupper($history->input_status ?? 'final') }}
                                </span>
                            </td>
                            <td>{{ $history->nama_saat_pak ?? $pegawai->nama }}</td>
                            <td>{{ $history->jf_saat_pak ?? $pegawai->jf }}</td>
                            <td>{{ $history->gol_saat_pak ?? $pegawai->gol }} / {{ $history->uk_saat_pak ?? $pegawai->uk }}</td>
                            <td>{{ $history->no_pak }}</td>
                            <td>{{ number_format((float) $history->ak_baru, 2, ',', '.') }}</td>
                            <td>{{ number_format((float) $history->ak_dasar_kp, 2, ',', '.') }}</td>
                            <td class="{{ $history->selisih_kp < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $history->selisih_kp > 0 ? '+' : '' }}{{ number_format($history->selisih_kp, 2, ',', '.') }}
                            </td>
                            <td>{{ number_format((float) $history->ak_dasar_jenjang, 2, ',', '.') }}</td>
                            <td>{{ number_format((float) $history->jumlah_ak, 2, ',', '.') }}</td>
                            <td class="{{ $history->selisih_jenjang < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $history->selisih_jenjang > 0 ? '+' : '' }}{{ number_format($history->selisih_jenjang, 2, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $history->status_evaluasi === 'Terpenuhi' ? 'success' : 'danger' }}">
                                    {{ $history->status_evaluasi }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('pak-histories.edit', $history) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    @if (($history->input_status ?? 'final') === 'draft')
                                        <form method="POST" action="{{ route('pak-histories.finalize', $history) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">Finalisasi</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('pak-histories.pdf', $history) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center text-muted py-4">Belum ada riwayat PAK untuk pegawai ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
