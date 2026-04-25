<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/csslogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/logo TI.png') }}">
</head>
<body>

<div class="container">

    <!-- KIRI -->
    <div class="left">
        <div>
            <h1>Selamat Datang Di Sismapres!</h1>
            <p style="line-height: 1.6;">
                Sistem Seleksi Mahasiswa Berprestasi <br><br>
                Isi data dengan benar dan pastikan email yang digunakan aktif untuk menerima informasi terbaru dari kami.
            </p>

            <div class="workflow">
                <h3><i class="fa-solid fa-route"></i> Alur Penggunaan</h3>
                <div class="workflow-list">
                    <div class="workflow-item">
                        <div class="step-num">1</div>
                        <span>Login</span>
                    </div>
                    <div class="workflow-item">
                        <div class="step-num">2</div>
                        <span>Isi Data Diri</span>
                    </div>
                    <div class="workflow-item">
                        <div class="step-num">3</div>
                        <span>Informasi Persyaratan Kriteria</span>
                    </div>
                    <div class="workflow-item">
                        <div class="step-num">4</div>
                        <span>Alur Jadwal Seleksi</span>
                    </div>
                    <div class="workflow-item">
                        <div class="step-num">5</div>
                        <span>Mengisi Data Sesuai Persyaratan Kriteria</span>
                    </div>
                    <div class="workflow-item">
                        <div class="step-num">6</div>
                        <span>Pengumuman Hasil Seleksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KANAN -->
    <div class="right">
        <div class="form-box">
            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <h2>Login</h2>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="login" placeholder="Masukkan Username atau Email" value="{{ old('login') }}" required>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                    <span class="toggle-password" onclick="togglePassword('password', this)">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        <svg class="eye-off-icon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                    </span>
                </div>

                <button type="submit">Masuk</button>

                <div class="footer">
                    Belum punya akun? <a href="{{ url('/register') }}">Daftar</a>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function togglePassword(inputId, span) {
        const input = document.getElementById(inputId);
        const eyeIcon = span.querySelector('.eye-icon');
        const eyeOffIcon = span.querySelector('.eye-off-icon');

        if (input.type === "password") {
            input.type = "text";
            eyeIcon.style.display = "none";
            eyeOffIcon.style.display = "block";
        } else {
            input.type = "password";
            eyeIcon.style.display = "block";
            eyeOffIcon.style.display = "none";
        }
    }
</script>
</body>
</html>