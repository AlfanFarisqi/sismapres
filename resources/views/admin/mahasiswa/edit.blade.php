@extends('admin.layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">

            <h2 class="fw-bold mb-0" style="color: #26415e;">Edit Data Mahasiswa</h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 25%;" class="fw-bold fs-5 bg-light">Nama</th>
                                <td><input type="text" class="form-control form-control-lg rounded-3" value="Alfan"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">NPM</th>
                                <td><input type="text" class="form-control form-control-lg rounded-3" value="2313020192"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Tingkat</th>
                                <td><input type="number" class="form-control form-control-lg rounded-3" value="3"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Email</th>
                                <td><input type="email" class="form-control form-control-lg rounded-3" value="asdas@gmail.com"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Telephone</th>
                                <td><input type="text" class="form-control form-control-lg rounded-3" value="0882222"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Alamat</th>
                                <td><textarea class="form-control form-control-lg rounded-3" rows="3">Jl. Contoh Alamat Mahasiswa No. 12</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="button" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>

                    <button type="button" onclick="window.location.href='{{ route('admin.mahasiswa.index') }}'" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection