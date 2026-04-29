@extends('layouts.app')

@section('title', 'Edit Riwayat PAK')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Edit Riwayat PAK</h1>
            <p class="text-muted mb-0">Perbarui draft/final untuk periode {{ $pakHistory->periode_tahun }}.</p>
        </div>
        <a href="{{ route('pak-histories.history', $pakHistory->nip) }}" class="btn btn-light">Kembali ke Riwayat</a>
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

    <form method="POST" action="{{ route('pak-histories.update', $pakHistory) }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" class="form-control" value="{{ $pakHistory->nip }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Input</label>
                    <select name="input_status" class="form-control" required>
                        <option value="draft" @selected(old('input_status', $pakHistory->input_status ?? 'final') === 'draft')>DRAFT</option>
                        <option value="final" @selected(old('input_status', $pakHistory->input_status ?? 'final') === 'final')>FINAL</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama_saat_pak" value="{{ old('nama_saat_pak', $pakHistory->nama_saat_pak) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">JF</label>
                    <input type="text" name="jf_saat_pak" value="{{ old('jf_saat_pak', $pakHistory->jf_saat_pak) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gol</label>
                    <input type="text" name="gol_saat_pak" value="{{ old('gol_saat_pak', $pakHistory->gol_saat_pak) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">UK</label>
                    <input type="text" name="uk_saat_pak" value="{{ old('uk_saat_pak', $pakHistory->uk_saat_pak) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Periode Tahun</label>
                    <input type="number" name="periode_tahun" value="{{ old('periode_tahun', $pakHistory->periode_tahun) }}" class="form-control" min="1900" max="2100" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal PAK</label>
                    <input type="date" name="tanggal_pak" value="{{ old('tanggal_pak', optional($pakHistory->tanggal_pak)->toDateString()) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No PAK</label>
                    <input type="text" name="no_pak" value="{{ old('no_pak', $pakHistory->no_pak) }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Baru</label>
                    <input type="number" step="0.01" name="ak_baru" value="{{ old('ak_baru', $pakHistory->ak_baru) }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Dasar KP</label>
                    <input type="number" step="0.01" name="ak_dasar_kp" value="{{ old('ak_dasar_kp', $pakHistory->ak_dasar_kp) }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Dasar Jenjang</label>
                    <input type="number" step="0.01" name="ak_dasar_jenjang" value="{{ old('ak_dasar_jenjang', $pakHistory->ak_dasar_jenjang) }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jumlah AK</label>
                    <input type="number" step="0.01" name="jumlah_ak" value="{{ old('jumlah_ak', $pakHistory->jumlah_ak) }}" class="form-control" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan', $pakHistory->keterangan) }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
            <a href="{{ route('pak-histories.history', $pakHistory->nip) }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
@endsection
