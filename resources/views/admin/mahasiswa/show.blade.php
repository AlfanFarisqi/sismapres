@extends('admin.layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-graduate me-3 fs-2 text-primary"></i>
            <h2 class="fw-bold mb-0" style="color: #26415e;">Detail Mahasiswa</h2>
        </div>

        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary rounded-3" style="color: white !important;">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-4 fs-5">
                    <tbody>
                        <tr>
                            <th style="width: 30%;" class="fw-bold">Nama</th>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">NPM</th>
                            <td>{{ $mahasiswa->npm }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Tingkat</th>
                            <td>{{ $mahasiswa->tingkat }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Email</th>
                            <td>{{ $mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Telephone</th>
                            <td>{{ $mahasiswa->no_hp }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Alamat</th>
                            <td>{{ $mahasiswa->alamat }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="btn text-white rounded-3" style="background-color:#f0c419;">
                    <i class="fas fa-pen me-2"></i>Edit
                </a>

                <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-3">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection