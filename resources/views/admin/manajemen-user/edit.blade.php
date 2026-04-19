@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h2 class="fw-bold mb-0" style="color: #26415e;">Edit Data User</h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 25%;" class="fw-bold fs-5 bg-light">Email</th>
                                <td><input type="email" class="form-control form-control-lg rounded-3" value="asdas@gmail.com"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Password Baru</th>
                                <td>
                                    <input type="password" class="form-control form-control-lg rounded-3" placeholder="Kosongkan jika tidak ingin mengubah password">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="button" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>

                    <button type="button" onclick="window.location.href='{{ route('admin.manajemen-user.index') }}'" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
