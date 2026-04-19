@extends('admin.layouts.app')

@section('content')

<h2 class="page-title"><i class="fa-solid fa-graduation-cap"></i> Data Mahasiswa</h2>

<div class="card-container">
    <div class="filter-section">
        <label for="search-nama">Nama Mahasiswa</label>
        <div class="search-box">
            <input type="text" id="search-nama" class="form-control" placeholder="Cari mahasiswa...">
            <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
        </div>
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
                <tr>
                    <td>Alfan</td>
                    <td>2313020192</td>
                    <td>3</td>
                    <td>asdas@gmail.com</td>
                    <td>0882222</td>
                    <td class="action-buttons">
                        <button class="btn btn-sm btn-info" title="Lihat"><i class="fa-solid fa-eye"></i></button>
                        <button class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <!-- More rows can be added here -->
            </tbody>
        </table>
    </div>
</div>

@endsection
