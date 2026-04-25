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
        <div class="search-box-wrapper">
            <label for="search-nama">Nama Mahasiswa</label>
            <form action="GET" method="">   
                <div class="search-box">
                    <input type="text" id="search-nama" name="search" class="form-control" placeholder="Cari mahasiswa...">
                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
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
                    <th>Telephone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $m)
                <tr>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->npm }}</td>
                    <td>{{ $m->tingkat }}</td>
                    <td>{{ $m->email }}</td>
                    <td>{{ $m->no_hp }}</td>
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
