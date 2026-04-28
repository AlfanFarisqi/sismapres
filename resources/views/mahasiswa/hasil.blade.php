<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hasil Seleksi</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #355872, #7AAACE);
    }

    .container {
        width: 90%;
        margin: 30px auto;
        background: #F7F8F0;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* HEADER */
    .header {
        display: flex;
        align-items: center;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .header h2 {
        margin-left: 10px;
        color: #355872;
    }

    /* TITLE */
    .title {
        text-align: center;
        margin-bottom: 20px;
        color: #355872;
    }

    /* SEARCH */
    .search-box {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .search-box input {
        width: 70%;
        padding: 10px;
        border-radius: 10px;
        border: none;
        background: #9CD5FF;
    }

    .search-box button {
        width: 25%;
        border: none;
        border-radius: 10px;
        background: #355872;
        color: white;
        cursor: pointer;
    }

    .search-box button:hover {
        background: #7AAACE;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #355872;
        color: white;
        padding: 10px;
    }

    td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #9CD5FF;
    }

</style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        👆 <h2>SISMAPRES</h2>
    </div>

    <!-- TITLE -->
    <div class="title">
        <h3>Tabel Hasil Seleksi Mahasiswa Berprestasi</h3>
        <p>Teknik Informatika 2026</p>
    </div>

    <!-- SEARCH -->
    <div class="search-box">
        <input type="text" placeholder="Cari Nama Mahasiswa...">
        <button>Cari</button>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tingkat</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ahmad Fauzi</td>
                <td>TI-3A</td>
                <td>Tingkat 3</td>
                <td>90</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Aminah</td>
                <td>TI-2B</td>
                <td>Tingkat 2</td>
                <td>85</td>
            </tr>
        </tbody>
    </table>

</div>

</body>
</html>