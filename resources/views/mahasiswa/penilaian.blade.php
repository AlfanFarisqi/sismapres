<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form Penilaian Seleksi</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('assets/img/LOGO UNP Kediri.png') }}">
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #F7F8F0;
        background-image: radial-gradient(#9CD5FF 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .container {
        width: 85%;
        margin: 30px auto;
        background: #FFFFFF;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #355872;
        margin-bottom: 30px;
    }

    .card {
        background: #9CD5FF;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .card h3 {
        margin-top: 0;
        color: #355872;
        font-size: 1.2rem;
        border-bottom: 2px solid rgba(53, 88, 114, 0.2);
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #355872;
        font-size: 0.9rem;
    }

    input, select, textarea {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        background: #fcfcfc;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #355872;
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(53, 88, 114, 0.1);
    }

    textarea {
        resize: none;
    }

    .note {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        font-style: italic;
    }

    .btn {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 12px;
        background: #355872;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn:hover {
        background: #7AAACE;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
</head>
<body>

<div class="container">
<h2>Form Penilaian Seleksi</h2>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('mahasiswa.penilaian.store') }}" enctype="multipart/form-data">
@csrf

<!-- C1 IPK -->
<div class="card">
    <h3><i class="fa-solid fa-graduation-cap"></i> C1 - IPK</h3>
    <div class="form-group">
        <label>Nilai IPK Terakhir</label>
        <input type="text" step="0.01" name="ipk" placeholder="Contoh: 3.75" required>
        <div class="note">* Masukkan IPK terakhir Anda dengan format angka (contoh: 3.75)</div>
    </div>
</div>

<!-- C2 Prestasi -->
<div class="card">
    <h3><i class="fa-solid fa-trophy"></i> C2 - Prestasi</h3>
    <div class="form-grid">
        <div class="form-group">
            <label>Jenis Prestasi</label>
            <input type="text" name="jenis_prestasi" placeholder="Akademik / Non Akademik" required>
        </div>
        <div class="form-group">
            <label>Tingkat Prestasi</label>
            <select name="tingkat_prestasi" required>
                <option value="1">Lokal / Jurusan</option>
                <option value="3">Regional</option>
                <option value="4">Nasional</option>
                <option value="5">Internasional</option>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Lomba / Kegiatan</label>
            <input type="text" name="nama_lomba" required>
        </div>
        <div class="form-group">
            <label>Tahun Prestasi</label>
            <input type="text" name="tahun_prestasi" required>
        </div>
        <div class="form-group full-width">
            <label>Upload Sertifikat (PDF)</label>
            <input type="file" name="file_prestasi" accept="application/pdf" required>
            <div class="note">Format: PDF maksimal 2MB</div>
        </div>
    </div>
</div>

<!-- C3 Organisasi -->
<div class="card">
    <h3><i class="fa-solid fa-users"></i> C3 - Keaktifan Organisasi</h3>
    <div class="form-grid">
        <div class="form-group">
            <label>Nama Organisasi</label>
            <input type="text" name="nama_organisasi" required>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select name="jabatan_organisasi" required>
                <option value="3">Anggota</option>
                <option value="4">Pengurus</option>
                <option value="5">Ketua</option>
            </select>
        </div>
        <div class="form-group">
            <label>Lama Aktif</label>
            <input type="text" name="lama_aktif" placeholder="Contoh: 2 Tahun" required>
        </div>
        <div class="form-group">
            <label>Upload Surat Organisasi (PDF)</label>
            <input type="file" name="file_organisasi" accept="application/pdf" required>
        </div>
    </div>
</div>

<!-- C4 Komunikasi -->
<div class="card">
    <h3><i class="fa-solid fa-comments"></i> C4 - Kemampuan Komunikasi</h3>
    <div class="form-group">
        <label>Pengalaman Presentasi / Lomba</label>
        <textarea name="pengalaman_komunikasi" rows="3" placeholder="Sebutkan pengalaman Anda dalam melakukan presentasi atau mengikuti lomba debat/pidato..." required></textarea>
        <div class="note">
            * Penilaian akhir akan dilakukan oleh admin melalui wawancara / presentasi
        </div>
    </div>
</div>

<!-- C5 Inovasi -->
<div class="card">
    <h3><i class="fa-solid fa-lightbulb"></i> C5 - Inovasi / Gagasan</h3>
    <div class="form-grid">
        <div class="form-group">
            <label>Judul Inovasi</label>
            <input type="text" name="judul_inovasi" required>
        </div>
        <div class="form-group">
            <label>Jenis Inovasi</label>
            <select name="jenis_inovasi" required>
                <option value="3">Ide</option>
                <option value="4">Proposal</option>
                <option value="5">Produk</option>
            </select>
        </div>
        <div class="form-group full-width">
            <label>Deskripsi Singkat</label>
            <textarea name="deskripsi_inovasi" rows="3" placeholder="Jelaskan secara singkat inovasi atau gagasan yang Anda buat..." required></textarea>
        </div>
        <div class="form-group full-width">
            <label>Upload Proposal / Laporan (PDF)</label>
            <input type="file" name="file_inovasi" accept="application/pdf" required>
        </div>
    </div>
</div>

<div style="margin-bottom: 50px;">
    <button type="submit" class="btn">
        <i class="fa-solid fa-paper-plane me-2"></i> Simpan Penilaian
    </button>
</div>

</form>
</div>

</body>
</html>