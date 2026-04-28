<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pengumuman</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #355872, #7AAACE);
}

/* CONTAINER */
.container {
    width: 90%;
    height: 85vh;
    margin: 40px auto;
    background: #F7F8F0;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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

/* OPTIONAL BUTTON */
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

    <!-- HEADER -->
    <div class="header">
        👆 SISMAPRES
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="announcement">
            <h2>📢 Pengumuman</h2>
            <p>
                Hasil seleksi mahasiswa berprestasi akan diumumkan<br>
                pada tanggal <b>30 Juni 2026</b>.
            </p>

            <button class="btn">Lihat Hasil</button>
        </div>
    </div>

</div>

</body>
</html>