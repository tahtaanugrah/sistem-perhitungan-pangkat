@extends('layouts.app')

@section('title', 'Input PAK Baru')

@section('content')
    @php
        $prefillNip = old('nip', $selectedPegawai?->nip ?? '');
        $prefillNama = old('nama', $selectedPegawai?->nama ?? '');
        $prefillJf = old('jf', $selectedPegawai?->jf ?? '');
        $prefillGol = old('gol', $selectedPegawai?->gol ?? $filterGol ?? '');
        $prefillUk = old('uk', $selectedPegawai?->uk ?? $filterUk ?? $selectedUk ?? '');
    @endphp

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="mb-1">Input PAK Baru</h1>
            <p class="text-muted mb-0">Gunakan filter Golongan dan Unit Kerja untuk mempercepat pemilihan pegawai.</p>
        </div>
        <a href="{{ route('dashboard', ['uk' => $selectedUk]) }}" class="btn btn-light">Kembali</a>
    </div>

    <form method="GET" action="{{ route('pak-histories.create') }}" class="card shadow-sm border-0 mb-4" id="pak-filter-form">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Filter Golongan</label>
                    <select name="filter_gol" class="form-control" id="filter_gol">
                        <option value="">Semua Golongan</option>
                        @foreach ($golonganOptions as $golongan)
                            <option value="{{ $golongan }}" @selected($filterGol === $golongan)>{{ $golongan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Filter Unit Kerja</label>
                    <select name="filter_uk" class="form-control" id="filter_uk">
                        <option value="">Semua Unit Kerja</option>
                        @foreach ($unitKerjaOptions as $unitKerja)
                            <option value="{{ $unitKerja }}" @selected($filterUk === $unitKerja)>{{ $unitKerja }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Pilih Pegawai (Opsional)</label>
                    <select name="pegawai_nip" class="form-control" id="pegawai_nip">
                        <option value="">Input manual</option>
                        @foreach ($filteredPegawai as $pegawai)
                            <option value="{{ $pegawai->nip }}" @selected($selectedPegawaiNip === $pegawai->nip)>
                                {{ $pegawai->nama }} - {{ $pegawai->nip }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary w-100">Terapkan</button>
                </div>
            </div>
            <div class="text-muted small">
                Menampilkan {{ $filteredPegawai->count() }} pegawai sesuai filter.
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pak-histories.store') }}" class="card shadow-sm border-0">
        @csrf
        <input type="hidden" name="input_status" value="final">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" value="{{ $prefillNip }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="{{ $prefillNama }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">JF</label>
                    <select name="jf" class="form-control" required>
                        <option value="">Pilih JF</option>
                        @if($prefillJf && !$jfOptions->contains($prefillJf))
                            <option value="{{ $prefillJf }}" selected>{{ $prefillJf }}</option>
                        @endif
                        @foreach ($jfOptions as $jf)
                            <option value="{{ $jf }}" @selected($prefillJf === $jf)>{{ $jf }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gol</label>
                    <select name="gol" class="form-control" required>
                        <option value="">Pilih Golongan</option>
                        @if($prefillGol && !$golonganOptions->contains($prefillGol))
                            <option value="{{ $prefillGol }}" selected>{{ $prefillGol }}</option>
                        @endif
                        @foreach ($golonganOptions as $golongan)
                            <option value="{{ $golongan }}" @selected($prefillGol === $golongan)>{{ $golongan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select name="uk" class="form-control" required>
                        <option value="">Pilih Unit Kerja</option>
                        @if($prefillUk && !$unitKerjaOptions->contains($prefillUk))
                            <option value="{{ $prefillUk }}" selected>{{ $prefillUk }}</option>
                        @endif
                        @foreach ($unitKerjaOptions as $unitKerja)
                            <option value="{{ $unitKerja }}" @selected($prefillUk === $unitKerja)>{{ $unitKerja }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Periode Tahun</label>
                    <input type="number" name="periode_tahun" value="{{ old('periode_tahun', now()->year) }}" class="form-control" min="1900" max="2100" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal PAK</label>
                    <input type="date" name="tanggal_pak" value="{{ old('tanggal_pak', now()->toDateString()) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No PAK</label>
                    <input type="text" name="no_pak" value="{{ old('no_pak') }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Baru</label>
                    <input type="number" step="0.01" name="ak_baru" value="{{ old('ak_baru') }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Dasar KP</label>
                    <input type="number" step="0.01" name="ak_dasar_kp" value="{{ old('ak_dasar_kp') }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">AK Dasar Jenjang</label>
                    <input type="number" step="0.01" name="ak_dasar_jenjang" value="{{ old('ak_dasar_jenjang') }}" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jumlah AK</label>
                    <input type="number" step="0.01" name="jumlah_ak" value="{{ old('jumlah_ak') }}" class="form-control" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
            <a href="{{ route('dashboard', ['uk' => $selectedUk]) }}" class="btn btn-light">Batal</a>
            <button type="submit" name="input_status" value="draft" class="btn btn-outline-warning">Simpan Draft</button>
            <button type="submit" name="input_status" value="final" class="btn btn-primary">Simpan Final</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('pak-filter-form');
            if (!form) {
                return;
            }

            const filterGol = document.getElementById('filter_gol');
            const filterUk = document.getElementById('filter_uk');
            const pegawaiNip = document.getElementById('pegawai_nip');

            const submitFilter = function (resetPegawai) {
                if (resetPegawai && pegawaiNip) {
                    pegawaiNip.value = '';
                }
                form.submit();
            };

            if (filterGol) {
                filterGol.addEventListener('change', function () {
                    submitFilter(true);
                });
            }

            if (filterUk) {
                filterUk.addEventListener('change', function () {
                    submitFilter(true);
                });
            }

            if (pegawaiNip) {
                pegawaiNip.addEventListener('change', function () {
                    submitFilter(false);
                });
            }
        });
    </script>
@endsection