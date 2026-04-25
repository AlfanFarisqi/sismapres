@extends('admin.layouts.app')

@section('title', 'Upload Berkas')

@section('content')
<h2 class="page-title"> Upload Berkas</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Verifikasi Berkas Mahasiswa</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk melihat dan memverifikasi berkas yang diunggah oleh mahasiswa.</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <label for="search">Nama Mahasiswa</label>
            <div class="search-box">
                <input type="text" id="search" class="form-control" placeholder="Cari mahasiswa...">
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Tingkat</th>
                    <th>Status</th>
                    <th style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}.</td>
                    <td class="fw-bold text-dark">{{ $m->nama }}</td>
                    <td>{{ $m->npm }}</td>
                    <td><span class="badge bg-primary-subtle text-primary rounded-pill px-3">Tingkat {{ $m->tingkat }}</span></td>
                    <td>
                        @if($m->status_berkas == 'lolos')
                            <span class="badge bg-success rounded-pill px-3"><i class="fa-solid fa-check me-1"></i> Lolos</span>
                        @elseif($m->status_berkas == 'tidak_lolos')
                            <span class="badge bg-danger rounded-pill px-3"><i class="fa-solid fa-xmark me-1"></i> Tidak Lolos</span>
                        @else
                            <span class="badge bg-warning text-dark rounded-pill px-3"><i class="fa-solid fa-clock me-1"></i> Belum Diperiksa</span>
                        @endif
                    </td>
                    <td class="action-buttons">
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary text-white btn-lihat-berkas rounded-3 px-3 shadow-sm" 
                                    data-nama="{{ $m->nama }}" 
                                    data-berkas="{{ json_encode($m->berkas) }}" 
                                    title="Lihat Berkas">
                                <i class="fa-solid fa-file-lines me-1"></i> Lihat Berkas
                            </button>
                            <button class="btn btn-sm btn-info text-white btn-verifikasi rounded-3 px-3 shadow-sm" 
                                    data-id="{{ $m->id }}" 
                                    data-nama="{{ $m->nama }}"
                                    data-status="{{ $m->status_berkas }}"
                                    style="background-color: #355872; border-color: #355872;">
                                <i class="fa-solid fa-check-to-slot me-1"></i> Verifikasi
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fa-solid fa-users-slash fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">Belum ada data pendaftar (mahasiswa).</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Lihat Berkas -->
<div class="modal fade" id="modalLihatBerkas" tabindex="-1" aria-labelledby="modalLihatBerkasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 text-white p-4" style="background-color: #355872;">
                <h5 class="modal-title fw-bold" id="modalLihatBerkasLabel">
                    <i class="fa-solid fa-folder-open me-2"></i> Berkas: <span id="namaMahasiswaBerkas" class="text-white-50"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div id="berkasListContainer" class="list-group gap-2">
                    <!-- Berkas List via JS -->
                </div>
            </div>
            <div class="modal-footer border-0 p-3 bg-white rounded-bottom-4 shadow-lg">
                <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 text-white p-4" style="background-color: #1a2c3a;">
                <h5 class="modal-title fw-bold" id="modalVerifikasiLabel">
                    <i class="fa-solid fa-check-to-slot me-2"></i> Verifikasi Berkas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formVerifikasi" method="POST" action="">
                @csrf
                <div class="modal-body p-4">
                    <p class="mb-4 text-muted">Tentukan status verifikasi administrasi/berkas untuk mahasiswa <strong class="text-dark"><span id="verifNamaMahasiswa"></span></strong>.</p>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark d-block">Status Verifikasi</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusLolos" value="lolos" required style="transform: scale(1.2);">
                                <label class="form-check-label fw-medium text-success ms-1" for="statusLolos">
                                    <i class="fa-solid fa-check-circle me-1"></i> Lolos Administrasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusTidakLolos" value="tidak_lolos" required style="transform: scale(1.2);">
                                <label class="form-check-label fw-medium text-danger ms-1" for="statusTidakLolos">
                                    <i class="fa-solid fa-times-circle me-1"></i> Tidak Lolos Administrasi
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-link text-muted text-decoration-none px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 shadow fw-bold" style="background-color: #355872; border-color: #355872;">
                        <i class="fa-solid fa-save me-2"></i> Simpan Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handling Lihat Berkas Modal
    const modalLihatBerkas = new bootstrap.Modal(document.getElementById('modalLihatBerkas'));
    const berkasListContainer = document.getElementById('berkasListContainer');
    const namaMahasiswaBerkas = document.getElementById('namaMahasiswaBerkas');

    document.querySelectorAll('.btn-lihat-berkas').forEach(btn => {
        btn.addEventListener('click', function() {
            const nama = this.dataset.nama;
            const berkas = JSON.parse(this.dataset.berkas || '[]');
            
            namaMahasiswaBerkas.textContent = nama;
            berkasListContainer.innerHTML = '';

            if (berkas.length > 0) {
                berkas.forEach(b => {
                    const item = document.createElement('a');
                    item.href = `/storage/${b.file_path}`;
                    item.target = '_blank';
                    item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 rounded-3 border-0 shadow-sm bg-white';
                    item.style.transition = "transform 0.2s, box-shadow 0.2s";
                    item.onmouseover = () => { item.style.transform = "translateY(-2px)"; item.style.boxShadow = "0 .5rem 1rem rgba(0,0,0,.15)"; };
                    item.onmouseout = () => { item.style.transform = "none"; item.style.boxShadow = "0 .125rem .25rem rgba(0,0,0,.075)"; };
                    item.innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="bg-danger-subtle text-danger p-3 rounded-3 me-3">
                                <i class="fa-solid fa-file-pdf fa-xl"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">${b.nama_berkas}</h6>
                                <small class="text-muted"><i class="fa-solid fa-eye me-1"></i> Klik untuk melihat dokumen</small>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-muted"></i>
                    `;
                    berkasListContainer.appendChild(item);
                });
            } else {
                berkasListContainer.innerHTML = `
                    <div class="text-center py-5 bg-white rounded-3 border border-dashed">
                        <i class="fa-solid fa-file-circle-xmark fa-3x mb-3 text-muted opacity-25"></i>
                        <p class="text-muted mb-0">Mahasiswa belum mengunggah berkas apapun.</p>
                    </div>
                `;
            }
            
            modalLihatBerkas.show();
        });
    });

    // Handling Verifikasi Modal
    const modalVerifikasi = new bootstrap.Modal(document.getElementById('modalVerifikasi'));
    const formVerifikasi = document.getElementById('formVerifikasi');
    const verifNamaMahasiswa = document.getElementById('verifNamaMahasiswa');

    document.querySelectorAll('.btn-verifikasi').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const status = this.dataset.status;

            verifNamaMahasiswa.textContent = nama;
            
            if (status === 'lolos') {
                document.getElementById('statusLolos').checked = true;
            } else if (status === 'tidak_lolos') {
                document.getElementById('statusTidakLolos').checked = true;
            } else {
                document.getElementById('statusLolos').checked = false;
                document.getElementById('statusTidakLolos').checked = false;
            }
            
            // Set action URL untuk form
            formVerifikasi.action = `/admin/upload-berkas/verifikasi/${id}`;
            
            modalVerifikasi.show();
        });
    });
});
</script>
@endsection