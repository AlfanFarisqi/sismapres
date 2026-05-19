<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pengumuman</title>
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

/* CONTAINER */
.container {
    width: 85%;
    margin: 30px auto;
    background: #FFFFFF;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}

/* HEADER */
.header {
    padding: 15px 25px;
    border-bottom: 2px solid #ddd;
    font-weight: bold;
    color: #355872;
    font-size: 20px;
}

/* CONTENT */
.content {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
}

/* BOX PENGUMUMAN */
.announcement {
    background: #9CD5FF;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
}

.announcement h2 {
    color: #355872;
    margin-bottom: 15px;
}

.announcement p {
    font-size: 18px;
    color: #333;
}

.btn {
    margin-top: 20px;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    background: #355872;
    color: white;
    cursor: pointer;
}

.btn:hover {
    background: #7AAACE;
}
</style>
</head>

<body>

<div class="container">
    <div class="header" style="display: flex; align-items: center;">
        <img src="{{ asset('assets/img/LOGO UNP Kediri.png') }}" alt="Logo UNP" style="height: 30px; margin-right: 10px;">
        SISMAPRES
    </div>

    <div class="content">
        <div class="announcement">
            <h2>Pengumuman</h2>
            @if($sudahDiumumkan)
                <p>
                    Hasil seleksi mahasiswa berprestasi telah diumumkan!<br>
                    Silakan klik tombol di bawah untuk melihat hasil.
                </p>
                <a href="{{ route('mahasiswa.hasil.index') }}" class="btn" style="text-decoration: none; display: inline-block;">Lihat Hasil</a>
            @else
                <p>
                    Hasil seleksi mahasiswa berprestasi akan diumumkan<br>
                    pada tanggal <b>{{ \Carbon\Carbon::parse($tanggalPengumuman)->format('d F Y') }}</b>.
                </p>
                <button class="btn" disabled style="background: #ccc; cursor: not-allowed;">Belum Tersedia</button>
            @endif
        </div>
    </div>
</div>

</body>
</html>