@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<h2 class="page-title"> Dashboard</h2>

<div class="welcome-box">
    <span>Selamat datang <b>ADMIN</b> Anda bisa mengelola sistem melalui pilihan menu di bawah</span>
    <span class="arrow"><i class="fa-solid fa-chevron-right"></i></span>
</div>

<div class="dashboard-grid">

    <!-- Row 1 -->
    <a href="{{ route('admin.mahasiswa.index') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-title">Data Mahasiswa</div>
        </div>
        <div class="stat-value"><b>{{ $countMahasiswa }}</b> Telah mendaftar</div>
    </a>

    <a href="{{ route('admin.kriteria.index') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-list"></i>
            </div>
            <div class="stat-title">Data Kriteria</div>
            <div style="margin-left: auto; color: #7AAACE; font-size: 20px;"><i class="fa-solid fa-pen-to-square"></i></div>
        </div>
        <div class="stat-value"><b>{{ $countKriteria }}</b> Kriteria penilaian</div>
    </a>

    <a href="{{ route('admin.data-penilaian.input') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon teal">
                <i class="fa-regular fa-square-check"></i>
            </div>
            <div class="stat-title">Data Penilaian</div>
        </div>
        <div class="stat-value"><b>{{ $countPenilaian }}</b> Data penilaian</div>
    </a>

    <!-- Row 2 -->
    <a href="{{ route('admin.upload-berkas.index') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="stat-title">Upload Berkas</div>
        </div>
        <div class="stat-value" style="margin-left: 60px; margin-top: -5px;">Verifikasi berkas</div>
    </a>

    <!-- Hasil Seleksi (Spans 2 Rows) -->
    <a href="{{ route('admin.hasil-seleksi.index') }}" class="stat-card span-row-2">
        <div class="stat-header">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="stat-title">Hasil Seleksi</div>
        </div>
        <div class="stat-value" style="margin-left: 0; color: #333;"><b style="font-size: 14px;">{{ $countSudahDinilai }}</b> Mahasiswa Sudah Dinilai</div>
        
        <ul class="ranking-list">
            @forelse($topRankings as $rank)
            <li>
                <div class="rank-badge">{{ $rank->ranking }}</div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($rank->mahasiswa->nama) }}&background={{ $loop->first ? '9CD5FF' : 'F7F8F0' }}&color=355872" class="rank-avatar" alt="{{ $rank->mahasiswa->nama }}">
                <div class="rank-name">{{ $rank->mahasiswa->nama }}</div>
            </li>
            @empty
            <li class="text-muted small py-3">Belum ada hasil seleksi</li>
            @endforelse
        </ul>
    </a>

    <a href="{{ route('admin.manajemen-user.index') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon teal">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-title">Manajemen User</div>
        </div>
        <div class="stat-value"><b>{{ $countUser }}</b> User terdaftar</div>
    </a>

    <!-- Row 3 -->
    <a href="{{ route('admin.kriteria.index') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-network-wired"></i>
            </div>
            <div class="stat-title">Data Kriteria</div>
        </div>
        <div class="stat-value"><b>{{ $countKriteria }}</b> Kriteria aktif</div>
    </a>

    <a href="{{ route('admin.data-penilaian.input') }}" class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="stat-title">Input Penilaian</div>
        </div>
        <div class="stat-value">Proses penilaian mahasiswa</div>
    </a>

</div>

<!-- Summary Section -->
<div class="summary-section">
    <a href="{{ route('admin.hasil-seleksi.index') }}" class="chart-area" style="text-decoration: none; color: inherit; display: block; transition: transform 0.3s ease;">
        <div class="chart-title">Rekapitulasi Penilaian Kriteria (Rata-rata Skor) <i class="fa-solid fa-arrow-up-right-from-square ms-2" style="font-size: 12px; opacity: 0.5;"></i></div>
        <div class="mock-chart d-flex align-items-end justify-content-around" style="height: 150px; padding-bottom: 20px;">
            @forelse($chartData as $data)
            <div class="bar-container d-flex flex-column align-items-center" style="height: 100%; width: 40px;" title="{{ $data['name'] }}: {{ $data['avg'] }}/5">
                <div class="bar-fill-dynamic" style="height: {{ $data['percentage'] }}%; width: 100%; background: #355872; border-radius: 4px 4px 0 0; transition: height 1s ease;"></div>
                <div class="bar-label-text mt-2" style="font-size: 10px; font-weight: bold; color: #355872;">{{ $data['label'] }}</div>
            </div>
            @empty
            <div class="text-muted small">Belum ada data penilaian</div>
            @endforelse
        </div>
    </a>
    <div class="summary-stats">
        <a href="{{ route('admin.mahasiswa.index') }}" class="summary-card" style="text-decoration: none; color: inherit;">
            <div class="summary-num">{{ $countMahasiswa }}</div>
            <div class="summary-text">Total Pendaftar</div>
        </a>
        <a href="{{ route('admin.manajemen-user.index') }}" class="summary-card" style="text-decoration: none; color: inherit;">
            <div class="summary-num">{{ $countUser }}</div>
            <div class="summary-text">User Terdaftar</div>
        </a>
    </div>
    <div class="summary-stats">
        <a href="{{ route('admin.upload-berkas.index') }}" class="summary-card light-blue" style="text-decoration: none; color: inherit;">
            <div class="summary-num">{{ $countLolosVerif }}</div>
            <div class="summary-text">Lolos Administrasi<small>Verifikasi Berkas</small></div>
        </a>
        <a href="{{ route('admin.data-penilaian.input') }}" class="summary-card light-blue" style="text-decoration: none; color: inherit;">
            <div class="summary-num">{{ $countSudahDinilai }}</div>
            <div class="summary-text">Sudah Dinilai<small>Proses Penilaian</small></div>
        </a>
    </div>
</div>

@endsection