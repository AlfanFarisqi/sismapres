<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penunjang Keputusan (SPK)</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <img src="{{ asset('img/LOGO UNP Kediri.png') }}" alt="Logo Universitas" class="logo-img"
                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Logo&background=355872&color=fff&rounded=true';">
            <div class="topbar-text">
                <div class="univ-name">UNIVERSITAS NUSANTARA PGRI KEDIRI</div>
                <div class="app-name">Sistem Penunjang Keputusan (SPK) Seleksi Mahasiswa Berprestasi</div>
                <div class="app-sub">Berbasis Metode TOPSIS</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="notification">
                <i class="fa-regular fa-bell"></i>
                <span class="badge">3</span>
            </div>
            <div class="user-profile">
                <span class="user-name">Admin</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=355872&color=fff&rounded=true" alt="Admin"
                    class="avatar">
            </div>
        </div>
    </header>

    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header-box">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </div>

            <ul class="menu">
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a href="/admin/dashboard"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                <li class="{{ request()->is('admin/mahasiswa*') ? 'active' : '' }}"><a href="{{ route('admin.mahasiswa.index') }}"><i class="fa-solid fa-graduation-cap"></i> Data Mahasiswa</a></li>
                <li class="{{ request()->is('admin/kriteria*') ? 'active' : '' }}"><a href="{{ route('admin.kriteria.index') }}"><i class="fa-solid fa-list-check"></i> Data Kriteria</a></li>
                <li class="{{ request()->is('admin/data-penilaian*') ? 'active' : '' }}"><a href="{{ route('admin.data-penilaian.input') }}"><i class="fa-solid fa-laptop"></i> Data Penilaian</a></li>
                <li class="{{ request()->is('admin/upload-berkas*') ? 'active' : '' }}"><a href="{{ route('admin.upload-berkas.index') }}"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Berkas</a></li>
                <li class="{{ request()->is('admin/hasil-seleksi*') ? 'active' : '' }}"><a href="{{ route('admin.hasil-seleksi.index') }}"><i class="fa-solid fa-trophy"></i> Hasil Seleksi</a></li>
                <li class="{{ request()->is('admin/manajemen-user*') ? 'active' : '' }}"><a href="{{ route('admin.manajemen-user.index') }}"><i class="fa-solid fa-users"></i> Manajemen User</a></li>
            </ul>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout" style="width: 100%; border: none; background: none; text-align: left; padding: 0;">
                    <i class="fa-solid fa-power-off"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main -->
        <main class="main">
            @yield('content')
        </main>
    </div>

</body>

</html>