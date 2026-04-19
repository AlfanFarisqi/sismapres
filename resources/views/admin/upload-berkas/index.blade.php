@extends('admin.layouts.app')

@section('title', 'Upload Berkas')

@section('content')
<h2 class="page-title"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Berkas</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Verifikasi Berkas Mahasiswa</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk melihat dan memverifikasi berkas yang diunggah oleh mahasiswa.</span>
    </div>
</div>

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <label for="search">Nama Mahasiswa</label>
            <div class="search-box">
                <input type="text" id="search" class="form-control" placeholder="Cari mahasiswa...">
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Tingkat</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Alfan</td>
                    <td>2313020192</td>
                    <td>3</td>
                    <td class="action-buttons">
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary text-white" title="Lihat Berkas"><i class="fa-solid fa-file-lines"></i> Lihat Berkas</button>
                            <button class="btn btn-sm btn-info text-white"><i class="fa-solid fa-check-to-slot"></i> Verifikasi</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection