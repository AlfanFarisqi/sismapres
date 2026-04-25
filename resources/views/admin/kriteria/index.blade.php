@extends('admin.layouts.app')

@section('title', 'Data Kriteria')

@section('content')

<h2 class="page-title"><img src="{{ asset('assets/logo TI.png') }}" alt="Logo" class="title-logo"> Data Kriteria</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Setting Data Kriteria</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk mengatur kriteria penilaian pada seleksi mahasiswa berprestasi.</span>
    </div>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKriteria">
        <i class="fa-solid fa-plus"></i> Tambah Kriteria
    </button>
</div>

<!-- Modal Tambah Kriteria -->
<div class="modal fade" id="modalTambahKriteria" tabindex="-1" aria-labelledby="modalTambahKriteriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-light rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahKriteriaLabel" style="color: #26415e;">Tambah Kriteria Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Kriteria</label>
                        <input type="text" class="form-control rounded-3" id="nama" name="nama" required placeholder="Contoh: IPK">
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="form-label fw-semibold">Bobot (%)</label>
                        <input type="number" class="form-control rounded-3" id="bobot" name="bobot" required placeholder="Contoh: 30">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label fw-semibold">Jenis Kriteria</label>
                        <select class="form-select rounded-3" id="jenis" name="jenis" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Kriteria</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <label for="search-kriteria">Daftar Kriteria</label>
        <form method="GET" action="">
            <div class="search-box">
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Cari kriteria...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
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
                @forelse($kriterias as $kriteria)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $kriteria->nama }}</td>
                    <td>{{ $kriteria->bobot }}%</td>
                    <td>{{ ucfirst($kriteria->jenis) }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data kriteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection