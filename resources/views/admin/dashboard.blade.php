@extends('admin.layouts.app')

@section('content')

<h2 class="page-title"><i class="fa-solid fa-house"></i> Dashboard</h2>

<div class="welcome-box">
    <span>Selamat datang <b>ADMIN</b> Anda bisa mengelola sistem melalui pilihan menu di bawah</span>
    <span class="arrow"><i class="fa-solid fa-chevron-right"></i></span>
</div>

<div class="dashboard-grid">

    <!-- Row 1 -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-title">Data Mahasiswa</div>
        </div>
        <div class="stat-value"><b>75</b> Telah mendaftar</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-list"></i>
            </div>
            <div class="stat-title">Data Kriteria</div>
            <div style="margin-left: auto; color: #7AAACE; font-size: 20px;"><i class="fa-solid fa-pen-to-square"></i></div>
        </div>
        <div class="stat-value"><b>5</b> Kriteria penilaian</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon teal">
                <i class="fa-regular fa-square-check"></i>
            </div>
            <div class="stat-title">Data Penilaian</div>
        </div>
        <div class="stat-value"><b>100</b> Data penilaian</div>
    </div>

    <!-- Row 2 -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="stat-title">Upload Berkas</div>
        </div>
        <div class="stat-value" style="margin-left: 60px; margin-top: -5px;">Verifikasi berkas</div>
    </div>

    <!-- Hasil Seleksi (Spans 2 Rows) -->
    <div class="stat-card span-row-2">
        <div style="position: absolute; top: -10px; right: 15px; background: #355872; color: white; border-radius: 50%; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; border: 3px solid white;">5</div>
        <div class="stat-header">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="stat-title">Hasil Seleksi</div>
        </div>
        <div class="stat-value" style="margin-left: 0; color: #333;"><b style="font-size: 14px;">1</b> TOP 3 Mahasiswa Berprestasi</div>
        
        <ul class="ranking-list">
            <li>
                <div class="rank-badge">1</div>
                <img src="https://ui-avatars.com/api/?name=Rahma+Putri&background=9CD5FF&color=355872" class="rank-avatar" alt="Rahma Putri">
                <div class="rank-name">Rahma Putri</div>
            </li>
            <li>
                <div class="rank-badge">2</div>
                <img src="https://ui-avatars.com/api/?name=Andi+Wijaya&background=F7F8F0&color=7AAACE" class="rank-avatar" alt="Andi Wijaya">
                <div class="rank-name">Andi Wijaya</div>
            </li>
            <li>
                <div class="rank-badge">3</div>
                <img src="https://ui-avatars.com/api/?name=Siti+Aisyah&background=355872&color=9CD5FF" class="rank-avatar" alt="Siti Aisyah">
                <div class="rank-name">Siti Aisyah</div>
            </li>
        </ul>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon teal">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-title">Manajemen User</div>
        </div>
        <div class="stat-value"><b>3</b> Admin terdaftar</div>
    </div>

    <!-- Row 3 -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-network-wired"></i>
            </div>
            <div class="stat-title">Data Kriteria</div>
        </div>
        <div class="stat-value"><b>75</b> Telah mendaftar</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="stat-title">ModeForm</div>
        </div>
        <div class="stat-value"><b>1</b> Jogginal perilal</div>
    </div>

</div>

<!-- Summary Section -->
<div class="summary-section">
    <div class="chart-area">
        <div class="chart-title">Rekapitulasi Seleksi Mahasiswa</div>
        <div class="mock-chart">
            <div class="bar bar-1" data-label="IPK"></div>
            <div class="bar bar-2" data-label="Prestasi"></div>
            <div class="bar bar-3" data-label="Organisasi"></div>
            <div class="bar bar-4" data-label="Komunikasi"></div>
            <div class="bar bar-5" data-label=""></div>
            <div class="bar bar-6" data-label="Inovasi"></div>
            <div class="bar bar-7" data-label="Inovasi"></div>
        </div>
    </div>
    <div class="summary-stats">
        <div class="summary-card">
            <div class="summary-num">75</div>
            <div class="summary-text">Pendaftar</div>
        </div>
        <div class="summary-card">
            <div class="summary-num">75</div>
            <div class="summary-text">Pendaftar</div>
        </div>
    </div>
    <div class="summary-stats">
        <div class="summary-card light-blue">
            <div class="summary-num">70</div>
            <div class="summary-text">Lolos Administrasi<small>Sudah Dinilai</small></div>
        </div>
        <div class="summary-card light-blue">
            <div class="summary-num">50</div>
            <div class="summary-text">Sudah Dinilai</div>
        </div>
    </div>
</div>

@endsection