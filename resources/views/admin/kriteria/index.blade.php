@extends('admin.layouts.app')

@section('title', 'Data Kriteria')

@section('content')

<h2 class="page-title"><i class="fa-solid fa-list-check"></i> Data Kriteria</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Setting Data Kriteria</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk mengatur kriteria penilaian pada seleksi mahasiswa berprestasi.</span>
    </div>
    <button class="btn btn-primary shadow-sm">
        <i class="fa-solid fa-plus"></i> Tambah Kriteria
    </button>
</div>

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <label for="search-kriteria">Daftar Kriteria</label>
        <div class="search-box">
            <input type="text" id="search-kriteria" class="form-control" placeholder="Cari kriteria...">
            <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Kriteria</th>
                    <th style="width: 140px;">Bobot</th>
                    <th style="width: 140px;">Jenis</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>IPK</td>
                    <td>30%</td>
                    <td>Benefit</td>
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