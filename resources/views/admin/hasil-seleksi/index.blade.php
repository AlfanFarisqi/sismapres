@extends('admin.layouts.app')

@section('title', 'Hasil Seleksi')

@section('content')
<h2 class="page-title"> Hasil Seleksi</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Tabel Hasil Seleksi Mahasiswa Berprestasi</h5>
        <span class="app-sub" style="color: #355872;">Program Studi Teknik Informatika Tahun 2026</span>
    </div>
    <button class="btn btn-warning shadow-sm" style="color: #fff; font-weight: 600;">
        <i class="fa-solid fa-print"></i> Cetak Laporan
    </button>
</div>

<!-- Tabel Mahasiswa Lolos & Dirangking -->
<div class="card-container mb-4">
    <div class="filter-section d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0" style="color: #1a2c3a;"><i class="fa-solid fa-trophy text-warning me-2"></i>Mahasiswa Lolos Perangkingan</h5>
        <div class="d-flex align-items-center gap-3">
            <label for="search-nama">Nama Mahasiswa</label>
            <div class="search-box">
                <input type="text" id="search-nama" class="form-control" placeholder="Cari mahasiswa...">
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 100px;" class="text-center">Peringkat</th>
                    <th>Nama Mahasiswa</th>
                    <th>NPM</th>
                    <th>Tingkat</th>
                    <th style="width: 150px;">Skor Akhir (V)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hasilSeleksi as $hasil)
                <tr>
                    <td class="text-center">
                        @if($hasil->ranking == 1)
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm" style="font-size: 14px;"><i class="fa-solid fa-medal me-1"></i> 1</span>
                        @elseif($hasil->ranking == 2)
                            <span class="badge bg-secondary px-3 py-2 rounded-pill shadow-sm" style="font-size: 14px;"><i class="fa-solid fa-medal me-1"></i> 2</span>
                        @elseif($hasil->ranking == 3)
                            <span class="badge px-3 py-2 rounded-pill shadow-sm" style="background-color: #cd7f32; font-size: 14px;"><i class="fa-solid fa-medal me-1"></i> 3</span>
                        @else
                            <span class="fw-bold text-muted">{{ $hasil->ranking }}</span>
                        @endif
                    </td>
                    <td class="fw-bold text-dark">{{ $hasil->mahasiswa->nama }}</td>
                    <td>{{ $hasil->mahasiswa->npm }}</td>
                    <td><span class="badge bg-primary-subtle text-primary rounded-pill px-3">Tingkat {{ $hasil->mahasiswa->tingkat }}</span></td>
                    <td><strong class="text-success">{{ number_format($hasil->total_skor, 4) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-chart-line fa-3x mb-3 opacity-25"></i>
                        <p class="mb-0">Belum ada hasil perangkingan yang diproses.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tabel Mahasiswa Tidak Lolos Administrasi -->
<div class="card-container border-top border-danger border-3">
    <div class="filter-section mb-3">
        <h5 class="fw-bold m-0 text-danger"><i class="fa-solid fa-ban me-2"></i>Mahasiswa Tidak Lolos Seleksi Berkas</h5>
        <span class="text-muted small">Mahasiswa di bawah ini gugur pada tahap administrasi sehingga tidak disertakan dalam proses penilaian dan perangkingan.</span>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NPM</th>
                    <th>Tingkat</th>
                    <th style="width: 250px;">Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tidakLolos as $index => $m)
                <tr>
                    <td class="text-muted">{{ $index + 1 }}.</td>
                    <td class="fw-bold text-dark">{{ $m->nama }}</td>
                    <td>{{ $m->npm }}</td>
                    <td><span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Tingkat {{ $m->tingkat }}</span></td>
                    <td>
                        <span class="badge bg-danger rounded-pill px-3 py-2"><i class="fa-solid fa-times-circle me-1"></i> Tidak Lolos Administrasi</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="fa-solid fa-check-double fa-2x mb-2 opacity-25"></i><br>
                        Tidak ada data mahasiswa yang gugur.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection