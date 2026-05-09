<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form Penilaian Seleksi</title>
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
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    h2 {
        text-align: center;
        color: #355872;
        margin-bottom: 30px;
    }

    .card {
        background: #9CD5FF;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .card h3 {
        margin-top: 0;
        color: #355872;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        color: #355872;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: none;
        margin-top: 5px;
        background: white;
    }

    textarea {
        resize: none;
    }

    input[type="file"] {
        background: #fff;
    }

    .note {
        font-size: 12px;
        color: #555;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #355872;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background: #7AAACE;
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
    <h3>C1 - IPK</h3>
    <label>Nilai IPK Terakhir</label>
    <input type="number" step="0.01" name="ipk" placeholder="Contoh: 3.75" required>
</div>

<!-- C2 Prestasi -->
<div class="card">
    <h3>C2 - Prestasi</h3>

    <label>Jenis Prestasi</label>
    <input type="text" name="jenis_prestasi" placeholder="Akademik / Non Akademik" required>

    <label>Tingkat Prestasi</label>
    <select name="tingkat_prestasi" required>
        <option value="1">Lokal / Jurusan</option>
        <option value="3">Regional</option>
        <option value="4">Nasional</option>
        <option value="5">Internasional</option>
    </select>

    <label>Nama Lomba / Kegiatan</label>
    <input type="text" name="nama_lomba" required>

    <label>Tahun Prestasi</label>
    <input type="number" name="tahun_prestasi" required>

    <label>Upload Sertifikat (PDF)</label>
    <input type="file" name="file_prestasi" accept="application/pdf" required>
    <div class="note">Format: PDF maksimal 2MB</div>
</div>

<!-- C3 Organisasi -->
<div class="card">
    <h3>C3 - Keaktifan Organisasi</h3>

    <label>Nama Organisasi</label>
    <input type="text" name="nama_organisasi" required>

    <label>Jabatan</label>
    <select name="jabatan_organisasi" required>
        <option value="3">Anggota</option>
        <option value="4">Pengurus</option>
        <option value="5">Ketua</option>
    </select>

    <label>Lama Aktif</label>
    <input type="text" name="lama_aktif" placeholder="Contoh: 2 Tahun" required>

    <label>Upload Surat Organisasi (PDF)</label>
    <input type="file" name="file_organisasi" accept="application/pdf" required>
</div>

<!-- C4 Komunikasi -->
<div class="card">
    <h3>C4 - Kemampuan Komunikasi</h3>

    <label>Pengalaman Presentasi / Lomba</label>
    <textarea name="pengalaman_komunikasi" rows="3" required></textarea>

    <div class="note">
        * Penilaian akhir akan dilakukan oleh admin melalui wawancara / presentasi
    </div>
</div>

<!-- C5 Inovasi -->
<div class="card">
    <h3>C5 - Inovasi / Gagasan</h3>

    <label>Judul Inovasi</label>
    <input type="text" name="judul_inovasi" required>

    <label>Deskripsi Singkat</label>
    <textarea name="deskripsi_inovasi" rows="3" required></textarea>

    <label>Jenis</label>
    <select name="jenis_inovasi" required>
        <option value="3">Ide</option>
        <option value="4">Proposal</option>
        <option value="5">Produk</option>
    </select>

    <label>Upload Proposal / Laporan (PDF)</label>
    <input type="file" name="file_inovasi" accept="application/pdf" required>
</div>

<button type="submit" class="btn">Simpan Penilaian</button>

</form>
</div>

</body>
</html>