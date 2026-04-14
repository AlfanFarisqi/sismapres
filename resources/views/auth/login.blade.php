<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #355872, #7AAACE);
        }

        .container {
            width: 90%;
            height: 90vh;
            margin: auto;
            margin-top: 20px;
            display: flex;
            background: #F7F8F0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        /* KIRI */
        .left {
            width: 50%;
            background: linear-gradient(135deg, #355872, #7AAACE);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .left h1 {
            font-size: 32px;
        }

        .left p {
            font-size: 18px;
            opacity: 0.9;
        }

        /* KANAN */
        .right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 80%;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #355872;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            background: #9CD5FF;
            outline: none;
        }

        input:focus {
            box-shadow: 0 0 5px #355872;
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: #355872;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #7AAACE;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .footer a {
            color: #355872;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- KIRI -->
    <div class="left">
        <div>
            <h1>Selamat Datang 👋</h1>
            <p style="line-height: 1.6;">
                Sistem Seleksi Siswa Berprestasi<br><br>
                <strong>Alur Penggunaan:</strong><br>
                Login ➔ Isi Data Diri ➔ Informasi Persyaratan Kriteria ➔ Alur Jadwal Seleksi ➔ Mengisi Data Sesuai Persyaratan Kriteria ➔ Pengumuman Hasil Seleksi
            </p>
        </div>
    </div>

    <!-- KANAN -->
    <div class="right">
        <div class="form-box">
            <form method="POST" action="#">
                @csrf

                <h2>Login</h2>

                <input type="text" name="username" placeholder="Masukkan Username">
                <input type="email" name="email" placeholder="Masukkan Email">
                <input type="password" name="password" placeholder="Masukkan Password">

                <button type="submit">Masuk</button>

                <div class="footer">
                    Belum punya akun? <a href="#">Daftar</a>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>