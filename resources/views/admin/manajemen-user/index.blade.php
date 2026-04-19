@extends('admin.layouts.app')

@section('title', 'Manajemen User')

@section('content')
<h2 class="page-title"><i class="fa-solid fa-users"></i> Manajemen User</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Pengelolaan Akun Pengguna</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk mengelola data akun pengguna pada sistem.</span>
    </div>
    <button class="btn btn-primary shadow-sm" title="Tambah User">
        <i class="fa-solid fa-plus"></i> Tambah User
    </button>
</div>

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <label for="search-email">Email</label>
            <div class="search-box">
                <input type="text" id="search-email" class="form-control" placeholder="Cari email...">
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>asdas@gmail.com</td>
                    <td>0882222</td>
                    <td class="action-buttons">
                        <button class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection