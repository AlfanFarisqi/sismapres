@extends('admin.layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">

            <h2 class="fw-bold mb-0" style="color: #26415e;"><img src="{{ asset('assets/logo TI.png') }}" alt="Logo" class="title-logo"> Edit Data Mahasiswa</h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 25%;" class="fw-bold fs-5 bg-light">Nama</th>
                                <td><input type="text" name="nama" class="form-control form-control-lg rounded-3" value="{{ old('nama', $mahasiswa->nama) }}" required></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">NPM</th>
                                <td><input type="text" name="npm" class="form-control form-control-lg rounded-3" value="{{ old('npm', $mahasiswa->npm) }}" required></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Tingkat</th>
                                <td><input type="number" name="tingkat" class="form-control form-control-lg rounded-3" value="{{ old('tingkat', $mahasiswa->tingkat) }}" required></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Email</th>
                                <td><input type="email" name="email" class="form-control form-control-lg rounded-3" value="{{ old('email', $mahasiswa->email) }}"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Telephone</th>
                                <td><input type="text" name="no_hp" class="form-control form-control-lg rounded-3" value="{{ old('no_hp', $mahasiswa->no_hp) }}"></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Alamat</th>
                                <td><textarea name="alamat" class="form-control form-control-lg rounded-3" rows="3">{{ old('alamat', $mahasiswa->alamat) }}</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection