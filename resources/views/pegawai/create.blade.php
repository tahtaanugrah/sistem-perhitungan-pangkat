@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Tambah Pegawai Baru</h1>
            <p class="text-muted mb-0">Data master pegawai untuk proses input PAK selanjutnya.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-light">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pegawai.store') }}" class="card border-0 shadow-sm">
        @csrf

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">JF</label>
                    <select name="jf" class="form-control" required>
                        <option value="">Pilih JF</option>
                        @foreach ($jfOptions as $jf)
                            <option value="{{ $jf }}" @selected(old('jf') === $jf)>{{ $jf }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Gol</label>
                    <select name="gol" class="form-control" required>
                        <option value="">Pilih Golongan</option>
                        @foreach ($golonganOptions as $golongan)
                            <option value="{{ $golongan }}" @selected(old('gol') === $golongan)>{{ $golongan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select name="uk" class="form-control" required>
                        <option value="">Pilih Unit Kerja</option>
                        @foreach ($unitKerjaOptions as $unitKerja)
                            <option value="{{ $unitKerja }}" @selected(old('uk') === $unitKerja)>{{ $unitKerja }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Pegawai</button>
        </div>
    </form>
@endsection
