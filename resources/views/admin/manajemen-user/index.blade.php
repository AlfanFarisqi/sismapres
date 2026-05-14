@extends('admin.layouts.app')

@section('title', 'Manajemen User')

@section('content')
<h2 class="page-title"> Manajemen User</h2>

<div class="welcome-box mb-4">
    <div>
        <h5 class="mb-1 fw-bold" style="color: #1a2c3a !important;">Pengelolaan Akun Pengguna</h5>
        <span class="app-sub" style="color: #355872;">Halaman ini digunakan untuk mengelola data akun pengguna pada sistem.</span>
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

<div class="card-container">
    <div class="filter-section d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('admin.manajemen-user.index') }}" method="GET" class="d-flex align-items-center gap-3">
                <label for="search-email">Email</label>
                <div class="search-box">
                    <input type="text" id="search-email" name="search" class="form-control" placeholder="Cari email..." value="{{ $search }}">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $u)
                <tr>
                    <td>{{ $index + 1 }}.</td>
                    <td>{{ $u->email }}</td>
                    <td>********</td>
                    <td class="action-buttons">
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-warning btn-edit-user" 
                                    data-id="{{ $u->id }}"
                                    data-name="{{ $u->name }}"
                                    data-email="{{ $u->email }}"
                                    data-username="{{ $u->username }}"
                                    data-role="{{ $u->role }}"
                                    title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <form action="{{ route('admin.manajemen-user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada user ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 text-white p-4" style="background-color: #355872;">
                <h5 class="modal-title fw-bold" id="modalEditUserLabel">
                    <i class="fa-solid fa-user-pen me-2"></i> Edit Akun Pengguna
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditUser" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-username" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" id="edit-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label fw-bold">Role</label>
                        <select class="form-control" id="edit-role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label fw-bold">Password Baru <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</small></label>
                        <input type="password" class="form-control" id="edit-password" name="password" placeholder="Min. 8 karakter">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-link text-muted text-decoration-none px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 shadow fw-bold" style="background-color: #355872; border-color: #355872;">
                        <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalEditUser = new bootstrap.Modal(document.getElementById('modalEditUser'));
    const formEditUser = document.getElementById('formEditUser');
    
    document.querySelectorAll('.btn-edit-user').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const username = this.dataset.username;
            const role = this.dataset.role;

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-role').value = role;
            document.getElementById('edit-password').value = '';
            
            formEditUser.action = `/admin/manajemen-user/${id}`;
            
            modalEditUser.show();
        });
    });
});
</script>
@endsection