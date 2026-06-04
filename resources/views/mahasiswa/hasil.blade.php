<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hasil Seleksi</title>
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
        margin: 30px auto;
        background: #FFFFFF;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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
        <img src="{{ asset('assets/img/LOGO UNP Kediri.png') }}" alt="Logo UNP" style="height: 40px; margin-right: 10px;">
        <h2>SISMAPRES</h2>
    </div>

    <!-- TITLE -->
    <div class="title">
        <h3>Tabel Hasil Seleksi Mahasiswa Berprestasi</h3>
        <p>Teknik Informatika 2026</p>
    </div>

    <!-- SEARCH -->
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari Nama Mahasiswa atau NPM...">
        <button id="searchBtn">Cari</button>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Tingkat</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody id="hasilTableBody">
            @forelse($hasilSeleksi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->mahasiswa->npm }}</td>
                <td>Tingkat {{ $item->mahasiswa->tingkat }}</td>
                <td>{{ number_format($item->total_skor, 4) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data hasil seleksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TITLE TIDAK LOLOS -->
    <div class="title" style="margin-top: 40px;">
        <h3>Tabel Mahasiswa Tidak Lolos Berkas</h3>
    </div>

    <!-- TABLE TIDAK LOLOS -->
    <table style="margin-bottom: 20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Tingkat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody id="tidakLolosTableBody">
            @forelse($tidakLolos as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->npm }}</td>
                <td>Tingkat {{ $mhs->tingkat }}</td>
                <td>Tidak Lolos Berkas</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data mahasiswa tidak lolos.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const tableBody = document.getElementById('hasilTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    const tidakLolosTableBody = document.getElementById('tidakLolosTableBody');
    const tidakLolosRows = tidakLolosTableBody ? tidakLolosTableBody.getElementsByTagName('tr') : [];

    function filterTable() {
        const query = searchInput.value.toLowerCase().trim();

        const filterRows = (rowList) => {
            for (let i = 0; i < rowList.length; i++) {
                const row = rowList[i];
                
                // Cek jika ini baris "Belum ada data"
                const firstCell = row.getElementsByTagName('td')[0];
                if (firstCell && firstCell.getAttribute('colspan') === '5') {
                    continue;
                }

                const namaCell = row.getElementsByTagName('td')[1];
                const npmCell = row.getElementsByTagName('td')[2];

                if (namaCell && npmCell) {
                    const namaText = namaCell.textContent || namaCell.innerText;
                    const npmText = npmCell.textContent || npmCell.innerText;

                    if (namaText.toLowerCase().includes(query) || npmText.toLowerCase().includes(query)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        };

        filterRows(rows);
        filterRows(tidakLolosRows);
    }

    // Jalankan filter saat tombol Cari diklik
    searchBtn.addEventListener('click', filterTable);

    // Jalankan filter otomatis secara real-time saat mengetik (opsional namun memudahkan user)
    searchInput.addEventListener('keyup', filterTable);
});
</script>

</body>
</html>