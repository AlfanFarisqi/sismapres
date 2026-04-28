<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form Penilaian Seleksi</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #355872, #7AAACE);
    }

    .container {
        width: 85%;
        margin: 30px auto;
        background: #F7F8F0;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
<h2>📊 Form Penilaian Seleksi</h2>

<form method="POST" action="#" enctype="multipart/form-data">
@csrf

<!-- C1 IPK -->
<div class="card">
    <h3>C1 - IPK</h3>
    <label>Nilai IPK Terakhir</label>
    <input type="number" step="0.01" placeholder="Contoh: 3.75">
</div>

<!-- C2 Prestasi -->
<div class="card">
    <h3>C2 - Prestasi</h3>

    <label>Jenis Prestasi</label>
    <input type="text" placeholder="Akademik / Non Akademik">

    <label>Tingkat Prestasi</label>
    <select>
        <option>Regional</option>
        <option>Nasional</option>
        <option>Internasional</option>
    </select>

    <label>Nama Lomba / Kegiatan</label>
    <input type="text">

    <label>Tahun Prestasi</label>
    <input type="number">

    <label>Upload Sertifikat (PDF)</label>
    <input type="file" accept="application/pdf">
    <div class="note">Format: PDF maksimal 2MB</div>
</div>

<!-- C3 Organisasi -->
<div class="card">
    <h3>C3 - Keaktifan Organisasi</h3>

    <label>Nama Organisasi</label>
    <input type="text">

    <label>Jabatan</label>
    <select>
        <option>Anggota</option>
        <option>Pengurus</option>
        <option>Ketua</option>
    </select>

    <label>Lama Aktif</label>
    <input type="text" placeholder="Contoh: 2 Tahun">

    <label>Upload Surat Organisasi (PDF)</label>
    <input type="file" accept="application/pdf">
</div>

<!-- C4 Komunikasi -->
<div class="card">
    <h3>C4 - Kemampuan Komunikasi</h3>

    <label>Pengalaman Presentasi / Lomba</label>
    <textarea rows="3"></textarea>

    <div class="note">
        * Penilaian akhir akan dilakukan oleh admin melalui wawancara / presentasi
    </div>
</div>

<!-- C5 Inovasi -->
<div class="card">
    <h3>C5 - Inovasi / Gagasan</h3>

    <label>Judul Inovasi</label>
    <input type="text">

    <label>Deskripsi Singkat</label>
    <textarea rows="3"></textarea>

    <label>Jenis</label>
    <select>
        <option>Ide</option>
        <option>Proposal</option>
        <option>Produk</option>
    </select>

    <label>Upload Proposal / Laporan (PDF)</label>
    <input type="file" accept="application/pdf">
</div>

<button class="btn">Simpan Penilaian</button>

</form>
</div>

</body>
</html>