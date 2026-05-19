<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Berkas</title>
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
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #355872;
    }

    .desc {
        text-align: center;
        font-size: 14px;
        margin-bottom: 30px;
        color: #555;
    }

    .file-card {
        background: #9CD5FF;
        padding: 20px;
        border-radius: 15px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .file-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .file-card label {
        font-weight: bold;
        color: #355872;
    }

    .file-card small {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="file"] {
        width: 100%;
        padding: 8px;
        border-radius: 10px;
        border: none;
        background: white;
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
        margin-top: 20px;
    }

    .btn:hover {
        background: #7AAACE;
    }
</style>
</head>
<body>

<div class="container">

    <h2>Upload Berkas Administrasi</h2>
    <div class="desc">
        Silakan upload dokumen berikut sebagai syarat administrasi.<br>
        Pastikan file jelas dan sesuai ketentuan.
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <form id="uploadForm" method="POST" action="{{ route('mahasiswa.berkas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="file-grid">
            <!-- KTM -->
            <div class="file-card" style="{{ isset($berkas['KTM']) ? 'border: 2px solid #28a745;' : '' }}">
                <div>
                    <label>KTM (Kartu Tanda Mahasiswa)</label>
                    <small>Status: {!! isset($berkas['KTM']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
                    <input type="file" name="berkas[KTM]" accept="application/pdf,image/*" {{ isset($berkas['KTM']) ? '' : 'required' }}>
                </div>
            </div>

            <!-- KTP -->
            <div class="file-card" style="{{ isset($berkas['KTP']) ? 'border: 2px solid #28a745;' : '' }}">
                <div>
                    <label>KTP (Kartu Tanda Penduduk)</label>
                    <small>Status: {!! isset($berkas['KTP']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
                    <input type="file" name="berkas[KTP]" accept="application/pdf,image/*" {{ isset($berkas['KTP']) ? '' : 'required' }}>
                </div>
            </div>

            <!-- KHS -->
            <div class="file-card" style="{{ isset($berkas['KHS']) ? 'border: 2px solid #28a745;' : '' }}">
                <div>
                    <label>KHS (Kartu Hasil Studi)</label>
                    <small>Status: {!! isset($berkas['KHS']) ? '<b style="color:green">✅ Terunggah</b>' : '<b style="color:red">❌ Belum Ada</b>' !!}</small>
                    <input type="file" name="berkas[KHS]" accept="application/pdf,image/*" {{ isset($berkas['KHS']) ? '' : 'required' }}>
                </div>
            </div>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="button" onclick="confirmSave()" style="border:none; color: #355872; text-decoration: none; font-weight: bold; background: #9CD5FF; padding: 10px 20px; border-radius: 10px; cursor: pointer; font-size: 16px;">Selanjutnya</button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmSave() {
    const form = document.getElementById('uploadForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    Swal.fire({
        title: 'Apakah Anda Yakin Ingin Menyimpan?',
        text: "Pastikan berkas yang diunggah sudah benar.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#355872',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
}
</script>

</body>
</html>