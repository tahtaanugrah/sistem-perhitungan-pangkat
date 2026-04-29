@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Edit Data Pegawai</h1>
            <p class="text-muted mb-0">Perbarui data master pegawai tanpa mengubah histori PAK per periode.</p>
        </div>
        <a href="{{ route('dashboard', ['uk' => $pegawai->uk]) }}" class="btn btn-light">Kembali</a>
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

    <form method="POST" action="{{ route('pegawai.update', $pegawai->nip) }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nip }}" readonly>
                    <small class="text-muted">NIP dikunci agar relasi histori tetap konsisten.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">JF</label>
                    <select name="jf" class="form-control" required>
                        @if(old('jf', $pegawai->jf) && !$jfOptions->contains(old('jf', $pegawai->jf)))
                            <option value="{{ old('jf', $pegawai->jf) }}" selected>{{ old('jf', $pegawai->jf) }}</option>
                        @endif
                        @foreach ($jfOptions as $jf)
                            <option value="{{ $jf }}" @selected(old('jf', $pegawai->jf) === $jf)>{{ $jf }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Gol</label>
                    <select name="gol" class="form-control" required>
                        @if(old('gol', $pegawai->gol) && !$golonganOptions->contains(old('gol', $pegawai->gol)))
                            <option value="{{ old('gol', $pegawai->gol) }}" selected>{{ old('gol', $pegawai->gol) }}</option>
                        @endif
                        @foreach ($golonganOptions as $golongan)
                            <option value="{{ $golongan }}" @selected(old('gol', $pegawai->gol) === $golongan)>{{ $golongan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select name="uk" class="form-control" required>
                        @if(old('uk', $pegawai->uk) && !$unitKerjaOptions->contains(old('uk', $pegawai->uk)))
                            <option value="{{ old('uk', $pegawai->uk) }}" selected>{{ old('uk', $pegawai->uk) }}</option>
                        @endif
                        @foreach ($unitKerjaOptions as $unitKerja)
                            <option value="{{ $unitKerja }}" @selected(old('uk', $pegawai->uk) === $unitKerja)>{{ $unitKerja }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
            <a href="{{ route('dashboard', ['uk' => $pegawai->uk]) }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        </div>
    </form>
@endsection
