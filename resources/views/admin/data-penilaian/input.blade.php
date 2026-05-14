@extends('admin.layouts.app')

@section('title', 'Data Penilaian')

@section('content')

<h2 class="page-title"> Data Penilaian</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Daftar Penilaian Mahasiswa</h5>
        <span class="app-sub" style="color: #355872;">Hasil penilaian otomatis berdasarkan kriteria yang telah ditentukan.</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm rounded-4" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 80px;">No</th>
                        <th class="py-3">Mahasiswa</th>
                        <th class="text-center py-3">Tingkat</th>
                        <th class="text-center py-3">Status Pemberitahuan</th>
                        <th class="text-center py-3" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $m)
                    <tr>
                        <td class="px-4 text-muted fw-medium">{{ $index + 1 }}.</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold">
                                    {{ substr($m->nama, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $m->nama }}</div>
                                    <div class="text-muted small"><i class="fa-solid fa-id-card me-1"></i> {{ $m->npm }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-medium">
                                <i class="fa-solid fa-layer-group me-1"></i> Tingkat {{ $m->tingkat }}
                            </span>
                        </td>
                        <td class="text-center">
                            @php
                                $nilaiCount = $penilaians->get($m->id)?->count() ?? 0;
                                $isComplete = $nilaiCount >= $kriterias->count() && $nilaiCount > 0;
                            @endphp
                            @if($isComplete)
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold border border-success-subtle">
                                    <i class="fa-solid fa-check-circle me-1"></i> Penilaian Sukses
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-bold border border-warning-subtle">
                                    <i class="fa-solid fa-clock me-1"></i> Belum Dinilai
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-info text-white rounded-3 px-3 btn-detail shadow-sm"
                                        data-id="{{ $m->id }}" 
                                        data-nama="{{ $m->nama }}"
                                        data-keterangan="{{ json_encode($penilaians->get($m->id)?->pluck('keterangan', 'kriteria_id')) }}">
                                    <i class="fa-solid fa-eye me-1"></i> Detail
                                </button>
                                <button class="btn btn-sm btn-primary rounded-3 px-3 btn-nilai shadow-sm" 
                                        style="background-color: #355872; border-color: #355872;"
                                        data-id="{{ $m->id }}" 
                                        data-nama="{{ $m->nama }}"
                                        data-berkas="{{ json_encode($m->berkas) }}"
                                        data-nilai="{{ json_encode($penilaians->get($m->id)?->pluck('nilai', 'kriteria_id')) }}"
                                        data-keterangan="{{ json_encode($penilaians->get($m->id)?->pluck('keterangan', 'kriteria_id')) }}">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Nilai
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fa-solid fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data mahasiswa untuk dinilai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Penilaian -->
<div class="modal fade" id="modalTambahPenilaian" tabindex="-1" aria-labelledby="modalTambahPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 text-white p-4" style="background-color: #355872;">
                <h5 class="modal-title fw-bold" id="modalTambahPenilaianLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Input Penilaian Mahasiswa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.data-penilaian.store') }}" method="POST" id="formPenilaian">
                @csrf
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <!-- Kolom Kiri: Berkas -->
                        <div class="col-md-5 bg-light border-end p-4">
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">

                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">
                                    <i class="fa-solid fa-file-lines me-2"></i> Persyaratan / Berkas Mahasiswa
                                </label>
                                <div id="berkas-list" class="d-flex flex-column gap-2">
                                    <!-- Berkas diisi via JS -->
                                </div>
                            </div>

                            <div class="alert alert-info border-0 rounded-3 small shadow-sm mt-4">
                                <i class="fa-solid fa-circle-info me-2"></i> 
                                Gunakan berkas di atas sebagai acuan untuk memberikan skor pada kriteria di samping.
                            </div>
                        </div>

                        <!-- Kolom Kanan: Scoring -->
                        <div class="col-md-7 p-4">
                            <h6 class="fw-bold mb-4 text-dark border-bottom pb-2">
                                <i class="fa-solid fa-star-half-stroke me-2"></i> Form Skor Penilaian
                            </h6>
                            
                            <div class="scoring-container pe-2">
                                @foreach($kriterias as $k)
                                <div class="kriteria-item mb-4 p-3 border rounded-4 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fw-bold text-dark">C{{ $loop->iteration }} - {{ $k->nama }}</span>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 small">bobot: {{ $k->bobot }}</span>
                                    </div>
                                    
                                    <div class="keterangan-mahasiswa mb-3 p-2 rounded-3 bg-light border-start border-4 border-info d-none">
                                        <small class="text-muted d-block mb-1"><i class="fa-solid fa-info-circle me-1"></i> Detail Input Mahasiswa:</small>
                                        <div class="fw-bold text-dark small ket-text"></div>
                                    </div>
                                    
                                    <div class="score-group d-flex justify-content-between gap-1" data-kriteria="{{ $k->id }}">
                                        @foreach([0,1,2,3,4,5] as $val)
                                        <button type="button" class="score-btn flex-fill py-2 rounded-3" data-value="{{ $val }}">{{ $val }}</button>
                                        @endforeach
                                        <input type="hidden" name="nilai[{{ $k->id }}]" class="skor-input" required>
                                    </div>
                                    
                                    @if($k->nama == 'IPK')
                                    <div class="mt-2 text-muted x-small">
                                        <i class="fa-solid fa-lightbulb me-1"></i> IPK: 5 (>3.75), 4 (3.50-3.75), 3 (3.25-3.49), 2 (3.00-3.24), 1 (<3.00), 0 (Kosong)
                                    </div>
                                    @endif
                                </div>
                                @endforeach

                                <!-- Tombol Submit Tambahan (Non-fungsional) -->
                                <div class="d-flex justify-content-end mt-3 mb-2">
                                    <button type="button" class="btn btn-primary rounded-3 px-4 py-2 shadow-sm fw-bold" style="background-color: #355872; border-color: #355872; opacity: 0.8; cursor: default;">
                                        <i class="fa-solid fa-paper-plane me-2"></i> Submit Penilaian
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-light rounded-bottom-4 shadow-lg">
                    <button type="button" class="btn btn-link text-muted text-decoration-none px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 shadow fw-bold" id="btnSubmitPenilaian" style="background-color: #355872; border-color: #355872;">
                        <i class="fa-solid fa-save me-2"></i> Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Penilaian -->
<div class="modal fade" id="modalDetailPenilaian" tabindex="-1" aria-labelledby="modalDetailPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 text-white p-4" style="background-color: #17a2b8;">
                <h5 class="modal-title fw-bold" id="modalDetailPenilaianLabel">
                    <i class="fa-solid fa-circle-info me-2"></i> Detail Input Mahasiswa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div id="detail-content" class="d-flex flex-column gap-3">
                    <!-- Detail diisi via JS -->
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-sm { width: 40px; height: 40px; }
    .avatar-sm.bg-primary-subtle { background-color: #e0e7ff; }
    .x-small { font-size: 0.75rem; }
    .score-btn {
        border: 1px solid #dee2e6;
        background: #fff;
        color: #495057;
        transition: all 0.2s;
        font-weight: 600;
    }
    .score-btn:hover { background: #f8f9fa; border-color: #0d6efd; }
    .score-btn.active {
        background: #355872;
        color: #fff;
        border-color: #355872;
        box-shadow: 0 4px 6px -1px rgba(53, 88, 114, 0.4);
        transform: translateY(-1px);
    }
    .scoring-container {
        max-height: 65vh;
        overflow-y: auto;
        overflow-x: hidden;
    }
    #berkas-list {
        max-height: 65vh;
        overflow-y: auto;
    }
    
    /* Custom Scrollbar */
    .scoring-container::-webkit-scrollbar,
    #berkas-list::-webkit-scrollbar {
        width: 6px;
    }
    .scoring-container::-webkit-scrollbar-track,
    #berkas-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .scoring-container::-webkit-scrollbar-thumb,
    #berkas-list::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    .scoring-container::-webkit-scrollbar-thumb:hover,
    #berkas-list::-webkit-scrollbar-thumb:hover {
        background: #355872;
    }
    .kriteria-item { transition: transform 0.2s; }
    .kriteria-item:hover { transform: scale(1.01); }
    .list-group-item-action { transition: all 0.2s; border-radius: 8px !important; margin-bottom: 5px; }
    .list-group-item-action:hover { transform: translateX(5px); background-color: #e9ecef; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scoreGroups = document.querySelectorAll('.score-group');
    const modal = new bootstrap.Modal(document.getElementById('modalTambahPenilaian'));
    const form = document.getElementById('formPenilaian');
    const btnSubmit = document.getElementById('btnSubmitPenilaian');
    const mahasiswaSelect = document.getElementById('mahasiswa_id');
    const modalTitle = document.getElementById('modalTambahPenilaianLabel');

    // Handle Score Buttons
    scoreGroups.forEach(group => {
        const buttons = group.querySelectorAll('.score-btn');
        const input = group.querySelector('.skor-input');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                input.value = this.dataset.value;
            });
        });
    });

    // Handle Detail Button Click
    const modalDetail = new bootstrap.Modal(document.getElementById('modalDetailPenilaian'));
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function() {
            const nama = this.dataset.nama;
            const ketData = JSON.parse(this.dataset.keterangan || '{}');
            const detailContent = document.getElementById('detail-content');
            
            document.getElementById('modalDetailPenilaianLabel').innerHTML = `<i class="fa-solid fa-circle-info me-2"></i> Detail Input: <span class="text-white-50">${nama}</span>`;
            
            detailContent.innerHTML = '';
            
            // Loop through kriteria names (we can use a static map or just rely on the data)
            const kriteriaNames = {
                1: 'C1 - IPK',
                2: 'C2 - Prestasi',
                3: 'C3 - Organisasi',
                4: 'C4 - Komunikasi',
                5: 'C5 - Inovasi'
            };

            let hasData = false;
            for (let id in kriteriaNames) {
                if (ketData[id]) {
                    hasData = true;
                    const item = document.createElement('div');
                    item.className = 'p-3 bg-white border rounded-3 shadow-sm';
                    item.innerHTML = `
                        <div class="fw-bold text-primary mb-2 border-bottom pb-1">${kriteriaNames[id]}</div>
                        <div class="text-dark small">${ketData[id]}</div>
                    `;
                    detailContent.appendChild(item);
                }
            }

            if (!hasData) {
                detailContent.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fa-solid fa-face-frown fa-3x text-muted mb-3 opacity-25"></i>
                        <p class="text-muted">Mahasiswa belum mengisi detail penilaian.</p>
                    </div>
                `;
            }

            modalDetail.show();
        });
    });

    // Handle Edit Button Click
    document.querySelectorAll('.btn-nilai').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const nilaiData = JSON.parse(this.dataset.nilai || '{}');
            const ketData = JSON.parse(this.dataset.keterangan || '{}');

            modalTitle.innerHTML = `<i class="fa-solid fa-pen-to-square me-2"></i> Edit Penilaian: <span class="text-white-50">${nama}</span>`;
            mahasiswaSelect.value = id;
            
            // Reset and set keterangan
            document.querySelectorAll('.kriteria-item').forEach(item => {
                const scoreGroup = item.querySelector('.score-group');
                if (scoreGroup) {
                    const kriteriaId = scoreGroup.dataset.kriteria;
                    const ketText = ketData[kriteriaId];
                    const ketDiv = item.querySelector('.keterangan-mahasiswa');
                    const ketContent = item.querySelector('.ket-text');
                    
                    if (ketText) {
                        ketDiv.classList.remove('d-none');
                        ketContent.innerText = ketText;
                    } else {
                        ketDiv.classList.add('d-none');
                    }
                }
            });

            // Render Berkas
            const berkasList = document.getElementById('berkas-list');
            const berkasData = JSON.parse(this.dataset.berkas || '[]');
            berkasList.innerHTML = '';
            
            if (berkasData.length > 0) {
                berkasData.forEach(b => {
                    const item = document.createElement('a');
                    item.href = `/storage/${b.file_path}`;
                    item.target = '_blank';
                    item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 bg-white border shadow-sm';
                    item.innerHTML = `
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-file-pdf text-danger fa-lg me-3"></i>
                            <div>
                                <div class="fw-bold small text-dark">${b.nama_berkas}</div>
                                <div class="x-small text-muted">Klik untuk melihat berkas</div>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    `;
                    berkasList.appendChild(item);
                });
            } else {
                berkasList.innerHTML = `
                    <div class="text-center py-4 bg-white border rounded-3 border-dashed">
                        <i class="fa-solid fa-file-circle-xmark fa-2x text-muted mb-2 opacity-50"></i>
                        <p class="text-muted small mb-0">Belum ada berkas yang diunggah.</p>
                    </div>
                `;
            }

            // Reset and Set scores
            document.querySelectorAll('.skor-input').forEach(input => {
                const kriteriaId = input.closest('.score-group').dataset.kriteria;
                const value = nilaiData[kriteriaId];
                input.value = value || '';
                
                const group = input.closest('.score-group');
                group.querySelectorAll('.score-btn').forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.value == value) {
                        btn.classList.add('active');
                    }
                });
            });

            modal.show();
        });
    });

    // Loading state on form submit
    form.addEventListener('submit', function() {
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...`;
    });

    // Reset modal on close
    document.getElementById('modalTambahPenilaian').addEventListener('hidden.bs.modal', function () {
        modalTitle.innerHTML = `<i class="fa-solid fa-pen-to-square me-2"></i> Input Penilaian Mahasiswa`;
        form.reset();
        document.querySelectorAll('.score-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.skor-input').forEach(input => input.value = '');
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = `<i class="fa-solid fa-save me-2"></i> Simpan Penilaian`;
    });
});
</script>
@endsection