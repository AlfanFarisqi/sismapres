@extends('admin.layouts.app')

@section('title', 'Input Penilaian')

@section('content')
<style>
    .kriteria-box {
        border: 1px solid #eee;
        border-radius: 10px;
        margin-bottom: 25px;
        background: #fff;
        overflow: hidden;
    }
    .kriteria-header {
        background: #F7F8F0;
        color: #355872;
        padding: 15px 20px;
        font-weight: 700;
        font-size: 16px;
        border-bottom: 1px solid #eee;
    }
    .kriteria-body {
        padding: 20px;
    }
    .kriteria-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #f0f0f0;
    }
    .kriteria-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .range-label {
        font-weight: 600;
        color: #444;
        font-size: 15px;
    }
    .score-group {
        display: flex;
        gap: 8px;
    }
    .score-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: #fff;
        color: #555;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .score-btn:hover {
        background: #f8f9fa;
        border-color: #9CD5FF;
    }
    .score-btn.active {
        background: #355872;
        color: #fff;
        border-color: #355872;
        box-shadow: 0 2px 4px rgba(53, 88, 114, 0.2);
    }
</style>

<h2 class="page-title"><i class="fa-solid fa-laptop"></i> Data Penilaian</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Input Penilaian Mahasiswa</h5>
        <span class="app-sub" style="color: #355872;">Tentukan skor nilai (1 hingga 5) untuk setiap sub-kriteria.</span>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form>
            {{-- IPK --}}
            <div class="kriteria-box">
                <div class="kriteria-header">C1 - IPK</div>
                <div class="kriteria-body">
                    <div class="kriteria-row">
                        <div class="range-label">3.76 - 4.00</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn active">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">3.50 - 3.75</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn active">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">3.25 - 3.49</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn active">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">&lt; 3.25</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn active">5</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pengalaman Prestasi --}}
            <div class="kriteria-box">
                <div class="kriteria-header">C2 - Prestasi</div>
                <div class="kriteria-body">
                    <div class="kriteria-row">
                        <div class="range-label">Tingkat Internasional</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn active">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Tingkat Nasional</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn active">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Tingkat Regional / Provinsi</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn active">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- C3 - Keaktifan Organisasi --}}
            <div class="kriteria-box">
                <div class="kriteria-header">C3 - Keaktifan Organisasi</div>
                <div class="kriteria-body">
                    <div class="kriteria-row">
                        <div class="range-label">Ketua / Badan Pengurus Harian</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn active">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Pengurus Inti Divisi / Panitia Utama</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn active">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Anggota / Partisipan Aktif</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn active">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Pasif / Tidak Mengikuti</div>
                        <div class="score-group">
                            <button type="button" class="score-btn active">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- C4 - Kemampuan Komunikasi --}}
            <div class="kriteria-box">
                <div class="kriteria-header">C4 - Kemampuan Komunikasi</div>
                <div class="kriteria-body">
                    <div class="kriteria-row">
                        <div class="range-label">Sangat Baik (Presentasi Sempurna, Menjawab Cerdas)</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn active">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Baik (Jelas dan Terstruktur)</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn active">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Cukup (Gugup Namun Tersampaikan)</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn active">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Kurang Baik / Sulit Dipahami</div>
                        <div class="score-group">
                            <button type="button" class="score-btn active">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- C5 - Inovasi / Gagasan --}}
            <div class="kriteria-box">
                <div class="kriteria-header">C5 - Inovasi / Gagasan</div>
                <div class="kriteria-body">
                    <div class="kriteria-row">
                        <div class="range-label">Produk Dibuat dan Diimplementasikan</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn active">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Proposal Lolos Didanai / Prototipe</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn active">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Hanya Sebatas Ide / Gagasan Konseptual</div>
                        <div class="score-group">
                            <button type="button" class="score-btn">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn active">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                    <div class="kriteria-row">
                        <div class="range-label">Tidak Relevan Atau Sangat Teoritis Biasa</div>
                        <div class="score-group">
                            <button type="button" class="score-btn active">1</button>
                            <button type="button" class="score-btn">2</button>
                            <button type="button" class="score-btn">3</button>
                            <button type="button" class="score-btn">4</button>
                            <button type="button" class="score-btn">5</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-2 d-flex gap-2">
                <button type="button" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                    <i class="fas fa-save me-2"></i>Simpan Penilaian
                </button>
                <button type="button" onclick="window.history.back()" class="btn rounded-3" style="background-color:#6c757d; color: white !important;">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scoreGroups = document.querySelectorAll('.score-group');
    
    scoreGroups.forEach(group => {
        const buttons = group.querySelectorAll('.score-btn');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Hapus class active dari semua tombol di grup yang sama
                buttons.forEach(btn => btn.classList.remove('active'));
                
                // Tambahkan class active ke tombol yang diklik
                this.classList.add('active');
            });
        });
    });
});
</script>
@endsection