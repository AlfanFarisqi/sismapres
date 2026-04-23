@extends('admin.layouts.app')

@section('title', 'Data Penilaian')

@section('content')

<h2 class="page-title"><i class="fa-solid fa-laptop"></i> Data Penilaian</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Daftar Penilaian Mahasiswa</h5>
        <span class="app-sub" style="color: #355872;">Hasil penilaian otomatis berdasarkan kriteria yang telah ditentukan.</span>
    </div>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPenilaian">
        <i class="fa-solid fa-plus"></i> Tambah Penilaian
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="px-3" style="width: 50px;">No</th>
                        <th>Mahasiswa</th>
                        @foreach($kriterias as $k)
                        <th class="text-center">{{ $k->nama }}</th>
                        @endforeach
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $m)
                    <tr>
                        <td class="px-3">{{ $index + 1 }}.</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $m->nama }}</div>
                            <small class="text-muted">{{ $m->npm }}</small>
                        </td>
                        @foreach($kriterias as $k)
                        <td class="text-center">
                            @php
                                $nilai = $penilaians->get($m->id)?->where('kriteria_id', $k->id)->first()?->nilai ?? '-';
                            @endphp
                            <span class="badge {{ $nilai != '-' ? 'bg-primary' : 'bg-light text-muted' }} rounded-pill px-3">
                                {{ $nilai }}
                            </span>
                        </td>
                        @endforeach
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary rounded-3 btn-nilai" 
                                    data-id="{{ $m->id }}" 
                                    data-nama="{{ $m->nama }}"
                                    data-nilai="{{ json_encode($penilaians->get($m->id)?->pluck('nilai', 'kriteria_id')) }}">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Nilai
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 3 + $kriterias->count() }}" class="text-center py-4 text-muted">Belum ada data mahasiswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Penilaian -->
<div class="modal fade" id="modalTambahPenilaian" tabindex="-1" aria-labelledby="modalTambahPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-light rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahPenilaianLabel" style="color: #26415e;">Input Penilaian Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.data-penilaian.store') }}" method="POST" id="formPenilaian">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label for="mahasiswa_id" class="form-label fw-bold">Pilih Mahasiswa</label>
                        <select name="mahasiswa_id" id="mahasiswa_id" class="form-select rounded-3 shadow-sm" required>
                            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswas as $m)
                            <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->npm }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 mb-4">
                        <i class="fa-solid fa-circle-info me-2"></i> Tentukan skor nilai (1 hingga 5) untuk setiap kriteria berikut.
                    </div>

                    @foreach($kriterias as $k)
                    <div class="kriteria-box">
                        <div class="kriteria-header">C{{ $loop->iteration }} - {{ $k->nama }}</div>
                        <div class="kriteria-body">
                            {{-- Rentang Panduan (Opsional, menyesuaikan dengan UI lama) --}}
                            @if($k->nama == 'IPK')
                                <div class="kriteria-row">
                                    <div class="range-label">Skor Penilaian (1-5)</div>
                                    <div class="score-group" data-kriteria="{{ $k->id }}">
                                        <button type="button" class="score-btn" data-value="1">1</button>
                                        <button type="button" class="score-btn" data-value="2">2</button>
                                        <button type="button" class="score-btn" data-value="3">3</button>
                                        <button type="button" class="score-btn" data-value="4">4</button>
                                        <button type="button" class="score-btn" data-value="5">5</button>
                                        <input type="hidden" name="nilai[{{ $k->id }}]" class="skor-input" required>
                                    </div>
                                </div>
                                <div class="mt-2 text-muted" style="font-size: 0.85rem;">
                                    Panduan: 5 (>3.75), 4 (3.50-3.75), 3 (3.25-3.49), 2 (3.00-3.24), 1 (<3.00)
                                </div>
                            @else
                                <div class="kriteria-row">
                                    <div class="range-label">Skor Penilaian (1-5)</div>
                                    <div class="score-group" data-kriteria="{{ $k->id }}">
                                        <button type="button" class="score-btn" data-value="1">1</button>
                                        <button type="button" class="score-btn" data-value="2">2</button>
                                        <button type="button" class="score-btn" data-value="3">3</button>
                                        <button type="button" class="score-btn" data-value="4">4</button>
                                        <button type="button" class="score-btn" data-value="5">5</button>
                                        <input type="hidden" name="nilai[{{ $k->id }}]" class="skor-input" required>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="modal-footer border-0 p-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">
                        <i class="fa-solid fa-save me-2"></i> Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scoreGroups = document.querySelectorAll('.score-group');
    const modal = new bootstrap.Modal(document.getElementById('modalTambahPenilaian'));
    const form = document.getElementById('formPenilaian');
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

    // Handle Edit Button Click
    document.querySelectorAll('.btn-nilai').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const nilaiData = JSON.parse(this.dataset.nilai || '{}');

            modalTitle.innerText = 'Edit Penilaian: ' + nama;
            mahasiswaSelect.value = id;
            
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

    // Reset modal on close
    document.getElementById('modalTambahPenilaian').addEventListener('hidden.bs.modal', function () {
        modalTitle.innerText = 'Input Penilaian Mahasiswa';
        form.reset();
        document.querySelectorAll('.score-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.skor-input').forEach(input => input.value = '');
    });
});
</script>
@endsection