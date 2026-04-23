<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informasi Seleksi</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #355872, #7AAACE);
        }

        .container {
            width: 90%;
            min-height: 90vh;
            margin: 20px auto;
            background: #F7F8F0;
            border-radius: 20px;
            display: flex;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .left, .right {
            width: 50%;
            padding: 40px;
        }

        .left {
            background: #9CD5FF;
        }

        .right {
            background: #F7F8F0;
        }

        h2 {
            color: #355872;
            margin-bottom: 20px;
        }

        h3 {
            color: #355872;
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 18px;
        }

        /* LIST KRITERIA */
        .criteria ul {
            padding-left: 20px;
        }

        .criteria li {
            margin-bottom: 12px;
            font-size: 16px;
        }

        /* FLOW / ALUR */
        .flow {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .step {
            background: #9CD5FF;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 15px;
        }

        /* BUTTON */
        .btn {
            margin-top: 30px;
            float: right;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            background: #355872;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #7AAACE;
        }

        .separator {
            width: 2px;
            background: white;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- KIRI: KRITERIA -->
    <div class="left">
        <h2>📌 Informasi Seleksi</h2>
        <div class="criteria">
            <h3>A. Persyaratan Umum :</h3>
            <ul>
                <li>Mahasiswa aktif Universitas Nusantara PGRI Kediri Tingkat II, III dan IV</li>
                <li>Usia tidak melebihi 22 tahun pertanggal 1 September 2026</li>
                <li>Memiliki integritas kepribadian (tidak pernah melakukan perbuatan tercela yang merugikan lingkungan kampus dan masyarakat)</li>
                <li>Memiliki kemampuan yang sangat memadai dalam berkomunikasi</li>
            </ul>

            <h3>B. Persyaratan Khusus :</h3>
            <ul>
                <li>IPK diatas 3,25</li>
                <li>Memiliki Prestasi paling rendah tingkat Regional</li>
                <li>Aktif di organisasi kemahasiswaan</li>
            </ul>

            <h3>C. Persyaratan Administrasi :</h3>
            <ul>
                <li>Foto copy KTM</li>
                <li>Foto copy KTP</li>
                <li>Foto copy KHS semester 1 sampai dengan akhir</li>
            </ul>
        </div>
    </div>

    <div class="separator"></div>

    <!-- KANAN: ALUR -->
    <div class="right">
        <h2>📊 Alur Seleksi</h2>

        <div class="flow">
            <div class="step">1. Login</div>
            <div class="step">2. Isi Data Diri</div>
            <div class="step">3. Informasi Persyaratan Kriteria</div>
            <div class="step">4. Alur Jadwal Seleksi</div>
            <div class="step">5. Mengisi Data Sesuai Kriteria</div>
            <div class="step">6. Pengumuman Hasil Seleksi</div>
        </div>

        <button class="btn">Daftar</button>
    </div>

</div>

</body>
</html>