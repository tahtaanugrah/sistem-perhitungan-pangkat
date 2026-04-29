@extends('layouts.app')

@section('title', 'Master Data')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Master Data</h1>
            <p class="text-muted mb-0">Kelola referensi Golongan, Jabatan Fungsional, dan Unit Kerja.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            @if (app()->environment('local'))
                <form method="POST" action="{{ route('master-data.seed-defaults') }}" onsubmit="return confirm('Jalankan seed default master data?');">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">Seed Master Data</button>
                </form>
            @endif
            <a href="{{ route('dashboard') }}" class="btn btn-light">Kembali</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" id="golongan">
                <div class="card-body">
                    <h5>Master Golongan</h5>
                    <form method="POST" action="{{ route('master-data.golongan.store') }}" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: III/c" required>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                    <ul class="list-group">
                        @forelse ($golonganList as $golongan)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $golongan->nama }}
                                <form method="POST" action="{{ route('master-data.golongan.destroy', $golongan) }}" class="js-delete-confirm" data-confirm-message="Hapus data golongan ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" id="jf">
                <div class="card-body">
                    <h5>Master JF</h5>
                    <form method="POST" action="{{ route('master-data.jf.store') }}" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Analis Kepegawaian Ahli Muda" required>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                    <ul class="list-group">
                        @forelse ($jfList as $jf)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $jf->nama }}
                                <form method="POST" action="{{ route('master-data.jf.destroy', $jf) }}" class="js-delete-confirm" data-confirm-message="Hapus data jabatan fungsional ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" id="unit-kerja">
                <div class="card-body">
                    <h5>Master Unit Kerja</h5>
                    <form method="POST" action="{{ route('master-data.unit-kerja.store') }}" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: BDL" required>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                    <ul class="list-group">
                        @forelse ($unitKerjaList as $unitKerja)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $unitKerja->nama }}
                                <form method="POST" action="{{ route('master-data.unit-kerja.destroy', $unitKerja) }}" class="js-delete-confirm" data-confirm-message="Hapus data unit kerja ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
