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

    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf

        <!-- KTM -->
        <div class="file-card">
            <label>KTM (Kartu Tanda Mahasiswa)</label>
            <small>Upload scan KTM yang masih berlaku (PDF)</small>
            <input type="file" accept="application/pdf">
        </div>

        <!-- KTP -->
        <div class="file-card">
            <label>KTP (Kartu Tanda Penduduk)</label>
            <small>Upload scan KTP yang jelas dan tidak buram (PDF)</small>
            <input type="file" accept="application/pdf">
        </div>

        <!-- KHS -->
        <div class="file-card">
            <label>KHS (Semester 1 - Terakhir)</label>
            <small>Upload seluruh KHS dalam satu file (PDF)</small>
            <input type="file" accept="application/pdf">
        </div>

        <button class="btn">Upload Berkas</button>
    </form>

</div>

</body>
</html>