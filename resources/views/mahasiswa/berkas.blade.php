<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Berkas</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #355872, #7AAACE);
    }

    .container {
        width: 70%;
        margin: 40px auto;
        background: #F7F8F0;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    h2 {
        text-align: center;
        color: #355872;
    }

    .desc {
        text-align: center;
        font-size: 14px;
        margin-bottom: 30px;
        color: #555;
    }

    .file-card {
        background: #9CD5FF;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    .file-card label {
        font-weight: bold;
        color: #355872;
    }

    .file-card small {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="file"] {
        width: 100%;
        padding: 8px;
        border-radius: 10px;
        border: none;
        background: white;
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
        margin-top: 20px;
    }

    .btn:hover {
        background: #7AAACE;
    }
</style>
</head>
<body>

<div class="container">

    <h2>📂 Upload Berkas Administrasi</h2>
    <div class="desc">
        Silakan upload dokumen berikut sebagai syarat administrasi.<br>
        Pastikan file jelas dan sesuai ketentuan.
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- KTM -->
    <form method="POST" action="{{ route('mahasiswa.berkas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="file-card" style="{{ isset($berkas['KTM']) ? 'border: 2px solid #28a745;' : '' }}">
            <label>KTM (Kartu Tanda Mahasiswa)</label>
            <small>Status: {!! isset($berkas['KTM']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
            <input type="hidden" name="nama_berkas" value="KTM">
            <input type="file" name="file" accept="application/pdf,image/*" required>
            <button type="submit" class="btn" style="margin-top: 10px;">{{ isset($berkas['KTM']) ? 'Ganti KTM' : 'Upload KTM' }}</button>
        </div>
    </form>

    <!-- KTP -->
    <form method="POST" action="{{ route('mahasiswa.berkas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="file-card" style="{{ isset($berkas['KTP']) ? 'border: 2px solid #28a745;' : '' }}">
            <label>KTP (Kartu Tanda Penduduk)</label>
            <small>Status: {!! isset($berkas['KTP']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
            <input type="hidden" name="nama_berkas" value="KTP">
            <input type="file" name="file" accept="application/pdf,image/*" required>
            <button type="submit" class="btn" style="margin-top: 10px;">{{ isset($berkas['KTP']) ? 'Ganti KTP' : 'Upload KTP' }}</button>
        </div>
    </form>

    <!-- KHS -->
    <form method="POST" action="{{ route('mahasiswa.berkas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="file-card" style="{{ isset($berkas['KHS']) ? 'border: 2px solid #28a745;' : '' }}">
            <label>KHS (Kartu Hasil Studi)</label>
            <small>Status: {!! isset($berkas['KHS']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
            <input type="hidden" name="nama_berkas" value="KHS">
            <input type="file" name="file" accept="application/pdf,image/*" required>
            <button type="submit" class="btn" style="margin-top: 10px;">{{ isset($berkas['KHS']) ? 'Ganti KHS' : 'Upload KHS' }}</button>
        </div>
    </form>

    <div style="text-align: right; margin-top: 20px;">
        <a href="{{ route('mahasiswa.penilaian.index') }}" style="color: #355872; text-decoration: none; font-weight: bold; background: #9CD5FF; padding: 10px 20px; border-radius: 10px;">Lanjut ke Form Penilaian ➡️</a>
    </div>

</div>

</body>
</html>