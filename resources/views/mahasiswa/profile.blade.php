<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #355872, #7AAACE);
        }

        .container {
            width: 90%;
            height: 90vh;
            margin: 20px auto;
            background: #F7F8F0;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            background: #355872;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .header span {
            margin-left: 10px;
        }

        /* CONTENT */
        .content {
            display: flex;
            height: calc(100% - 60px);
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
    <div class="header">
        👆 <span>SISMAPRES</span>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- KIRI -->
        <div class="left">
            <div class="profile-card">
                <div class="profile-img"></div>
                <button class="upload-btn">Upload Foto</button>
            </div>
        </div>

        <div class="separator"></div>

        <!-- KANAN -->
        <div class="right">
            <form>
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>NPM</label>
                    <input type="number">
                </div>

                <div class="form-group">
                    <label>Tingkat</label>
                    <select name="tingkat">
                        <option value="" disabled selected>Pilih Tingkat</option>
                        <option value="2">Tingkat 2</option>
                        <option value="3">Tingkat 3</option>
                        <option value="4">Tingkat 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" pattern=".+@gmail\.com" title="Harap masukkan email dengan domain @gmail.com" required>
                </div>

                <div class="form-group">
                    <label>No. Phone</label>
                    <input type="number">
                </div>

                <button class="btn-save">Simpan</button>
            </form>
        </div>

    </div>

</div>

</body>
</html>