@extends('admin.layouts.app')

@section('title', 'Hasil Seleksi')

@section('content')
<h2 class="page-title"><i class="fa-solid fa-trophy"></i> Hasil Seleksi</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Tabel Hasil Seleksi Mahasiswa Berprestasi</h5>
        <span class="app-sub" style="color: #355872;">Program Studi Teknik Informatika Tahun 2026</span>
    </div>
    <button class="btn btn-warning shadow-sm" style="color: #fff; font-weight: 600;">
        <i class="fa-solid fa-print"></i> Cetak Laporan
    </button>
</div>

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <label for="search-nama">Nama Mahasiswa</label>
            <div class="search-box">
                <input type="text" id="search-nama" class="form-control" placeholder="Cari mahasiswa...">
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
                    <th>Kelas</th>
                    <th>Tingkat</th>
                    <th style="width: 150px;">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Alfan</td>
                    <td>A</td>
                    <td>3</td>
                    <td><strong>0.897</strong></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Budi</td>
                    <td>B</td>
                    <td>3</td>
                    <td><strong>0.845</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection