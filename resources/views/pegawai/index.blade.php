@extends('layouts.app')

@section('title', 'Daftar Pegawai')

@section('content')
    <style>
        .pegawai-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0.15rem 0;
            margin-top: 0.4rem;
        }

        .pegawai-toolbar .btn {
            min-width: 146px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .pegawai-toolbar .btn-group .btn {
            min-width: 146px;
        }

        .pegawai-toolbar .dropdown-menu {
            min-width: 146px;
        }

        @media (max-width: 575.98px) {
            .pegawai-toolbar {
                width: 100%;
            }

            .pegawai-toolbar .btn {
                flex: 1 1 100%;
                width: 100%;
            }
        }
    </style>

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 py-1">
        <div>
            <h1 class="mb-1">Daftar Pegawai</h1>
            <p class="text-muted mb-0">Cari dan filter pegawai berdasarkan unit kerja, golongan, JF, atau kata kunci.</p>
        </div>
        <div class="pegawai-toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('pak-histories.export.excel', array_filter([
                        'q' => $filters['q'] ?? null,
                        'uk' => $filters['uk'] ?? null,
                        'gol' => $filters['gol'] ?? null,
                        'jf' => $filters['jf'] ?? null,
                    ], fn ($value) => $value !== null && $value !== '')) }}">Export Excel</a>
                    <a class="dropdown-item" href="{{ route('pak-histories.export.pdf', array_filter([
                        'q' => $filters['q'] ?? null,
                        'uk' => $filters['uk'] ?? null,
                        'gol' => $filters['gol'] ?? null,
                        'jf' => $filters['jf'] ?? null,
                    ], fn ($value) => $value !== null && $value !== '')) }}">Export PDF</a>
                </div>
            </div>
            <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Pegawai Baru</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
        </div>
    </div>

    <div class="alert alert-info mb-4">
        Export Excel dan PDF mengikuti filter aktif, dan hanya mengekspor data dengan status FINAL.
    </div>

    <form method="GET" action="{{ route('pegawai.index') }}" class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="q" value="{{ $filters['q'] }}" class="form-control" placeholder="Cari NIP atau nama pegawai">
                </div>
                <div class="col-lg-3 mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select name="uk" class="form-control">
                        <option value="">Semua Unit Kerja</option>
                        @foreach ($unitKerjaOptions as $unitKerja)
                            <option value="{{ $unitKerja }}" @selected($filters['uk'] === $unitKerja)>{{ $unitKerja }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <label class="form-label">Golongan</label>
                    <select name="gol" class="form-control">
                        <option value="">Semua Gol</option>
                        @foreach ($golonganOptions as $golongan)
                            <option value="{{ $golongan }}" @selected($filters['gol'] === $golongan)>{{ $golongan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 mb-3">
                    <label class="form-label">JF</label>
                    <select name="jf" class="form-control">
                        <option value="">Semua JF</option>
                        @foreach ($jfOptions as $jf)
                            <option value="{{ $jf }}" @selected($filters['jf'] === $jf)>{{ $jf }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('pegawai.index') }}" class="btn btn-light">Reset Filter</a>
                <button type="submit" class="btn btn-outline-primary">Terapkan Filter</button>
            </div>
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>JF</th>
                        <th>Gol</th>
                        <th>UK</th>
                        <th>Periode</th>
                        <th>Status PAK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawaiList as $pegawai)
                        @php($pakHistory = $pegawai->latestPakHistory)
                        <tr>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>{{ $pegawai->jf }}</td>
                            <td>{{ $pegawai->gol }}</td>
                            <td>{{ $pegawai->uk }}</td>
                            <td>{{ $pakHistory?->periode_tahun ?? '-' }}</td>
                            <td>
                                @if ($pakHistory)
                                    <span class="badge badge-{{ ($pakHistory->input_status ?? 'final') === 'draft' ? 'warning' : 'success' }}">
                                        {{ strtoupper($pakHistory->input_status ?? 'final') }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Belum Ada Data</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('pegawai.edit', $pegawai->nip) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <a href="{{ route('pak-histories.history', $pegawai->nip) }}" class="btn btn-sm btn-outline-primary">Riwayat</a>
                                    @if ($pakHistory)
                                        <a href="{{ route('pak-histories.pdf', $pakHistory) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                    @endif
                                    <form method="POST" action="{{ route('pegawai.destroy', $pegawai->nip) }}" class="d-inline js-delete-confirm" data-confirm-message="Hapus pegawai {{ $pegawai->nama }} ({{ $pegawai->nip }}) beserta riwayat PAK terkait?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada pegawai yang sesuai filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection