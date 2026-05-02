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

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('mahasiswa.penilaian.store') }}" enctype="multipart/form-data">
@csrf

@foreach($kriterias as $k)
<div class="card">
    <h3>{{ $k->nama }}</h3>
    <label>Masukkan Nilai/Skor</label>
    <input type="number" name="nilai[{{ $k->id }}]" value="{{ $penilaians[$k->id] ?? '' }}" required>
    <div class="note">Jenis Kriteria: {{ ucfirst($k->jenis) }} | Bobot: {{ $k->bobot }}%</div>
</div>
@endforeach

<button type="submit" class="btn">Simpan Penilaian</button>

</form>

<div style="text-align: right; margin-top: 20px;">
    <a href="{{ route('mahasiswa.pengumuman') }}" style="color: #355872; text-decoration: none; font-weight: bold;">Lihat Pengumuman ➡️</a>
</div>

</div>

</body>
</html>