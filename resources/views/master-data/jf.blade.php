@extends('layouts.app')

@section('title', 'Master JF')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Master Jabatan Fungsional</h1>
            <p class="text-muted mb-0">Kelola referensi JF untuk dropdown pegawai dan PAK.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-light">Kembali</a>
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

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('master-data.jf.store') }}" class="d-flex flex-wrap gap-2">
                @csrf
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Contoh: Analis Kepegawaian Ahli Muda" required style="max-width: 420px;">
                <button type="submit" class="btn btn-primary">Tambah JF</button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $jf)
                        <tr>
                            <td>{{ $jf->nama }}</td>
                            <td>
                                <span class="badge badge-success">Aktif</span>
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('master-data.jf.destroy', $jf) }}" class="d-inline js-delete-confirm" data-confirm-message="Hapus data jabatan fungsional ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data JF.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
