@extends('admin.layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')

<h2 class="page-title"> Data Mahasiswa</h2>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <div class="search-box-wrapper flex-grow-1 me-3">
            <form action="{{ route('admin.mahasiswa.index') }}" method="GET">   
                <div class="d-flex gap-2">
                    <div class="flex-grow-1">
                        <label for="search-nama">Cari Mahasiswa</label>
                        <input type="text" id="search-nama" name="search" class="form-control w-100" placeholder="Nama atau NPM..." value="{{ $search }}">
                    </div>
                    <div>
                        <label for="filter-status">Status Berkas</label>
                        <select name="status" id="filter-status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="lolos" {{ $status == 'lolos' ? 'selected' : '' }}>Lolos (Aktif)</option>
                            <option value="tidak_lolos" {{ $status == 'tidak_lolos' ? 'selected' : '' }}>Tidak Lolos (Belum Aktif)</option>
                        </select>
                    </div>
                    <div class="align-self-end">
                        <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <a href="#" class="btn btn-success mt-4"><i class="fa-solid fa-plus"></i> Tambah Mahasiswa</a> --}}
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Tingkat</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $m)
                <tr>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->npm }}</td>
                    <td>Semester {{ $m->tingkat }}</td>
                    <td>{{ $m->email }}</td>
                    <td>
                        @if($m->status_berkas == 'lolos')
                            <span class="badge bg-success">Lolos</span>
                        @elseif($m->status_berkas == 'tidak_lolos')
                            <span class="badge bg-danger">Tidak Lolos</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.mahasiswa.edit', $m->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data mahasiswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
