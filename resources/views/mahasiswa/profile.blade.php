<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
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
            min-height: 90vh;
            margin: 30px auto;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            padding: 20px 30px;
            border-bottom: 2px solid #f0f0f0;
            background: #ffffff;
            color: #355872;
            font-size: 22px;
            font-weight: bold;
        }

        .header span {
            margin-left: 10px;
        }

        /* CONTENT */
        .content {
            display: flex;
        }

        /* KIRI */
        .left {
            width: 40%;
            background: #9CD5FF;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-card {
            text-align: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #355872;
            margin: auto;
            margin-bottom: 20px;
        }

        .upload-btn {
            padding: 8px 15px;
            border: none;
            background: #355872;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        /* GARIS */
        .separator {
            width: 2px;
            background: white;
        }

        /* KANAN */
        .right {
            width: 60%;
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #355872;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 10px;
            border: none;
            background: #9CD5FF;
            outline: none;
            font-family: inherit;
        }

        input:focus, select:focus {
            box-shadow: 0 0 5px #355872;
        }

        .btn-save {
            float: right;
            padding: 10px 20px;
            border: none;
            background: #355872;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #7AAACE;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header" style="justify-content: space-between;">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('assets/img/LOGO UNP Kediri.png') }}" alt="Logo UNP" style="height: 40px; margin-right: 15px;">
            <span>SISMAPRES</span>
        </div>
        <a href="{{ route('mahasiswa.informasi') }}" style="color: #355872; text-decoration: none; font-size: 14px; border: 1px solid #355872; padding: 8px 20px; border-radius: 10px; font-weight: 600; transition: 0.3s;">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- CONTENT -->
    <form action="{{ route('mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content">

            <!-- KIRI -->
            <div class="left">
                <div class="profile-card">
                    <div class="profile-img" id="imgPreview" style="{{ isset($mahasiswa) && $mahasiswa->foto ? 'background-image: url(' . asset('storage/' . $mahasiswa->foto) . ');' : '' }} background-size: cover; background-position: center;"></div>
                    <input type="file" name="foto" id="fotoInput" style="display:none" accept="image/*">
                    <button type="button" class="upload-btn" onclick="document.getElementById('fotoInput').click()">Pilih Foto</button>
                </div>
            </div>

            <div class="separator"></div>

            <!-- KANAN -->
            <div class="right">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>NPM</label>
                    <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Tingkat</label>
                    <select name="tingkat" required>
                        <option value="" disabled {{ !isset($mahasiswa) ? 'selected' : '' }}>Pilih Tingkat</option>
                        <option value="2" {{ (isset($mahasiswa) && $mahasiswa->tingkat == 2) ? 'selected' : '' }}>Tingkat 2</option>
                        <option value="3" {{ (isset($mahasiswa) && $mahasiswa->tingkat == 3) ? 'selected' : '' }}>Tingkat 3</option>
                        <option value="4" {{ (isset($mahasiswa) && $mahasiswa->tingkat == 4) ? 'selected' : '' }}>Tingkat 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" disabled>
                    <small style="color: #666;">Email tidak dapat diubah.</small>
                </div>

                <div class="form-group">
                    <label>No. Phone</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" style="width: 100%; padding: 10px; border-radius: 10px; border: none; background: #9CD5FF; outline: none; font-family: inherit;">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn-save">Simpan & Lanjut</button>
            </div>

        </div>
    </form>

</div>

<script>
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgPreview').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
</body>
</html>