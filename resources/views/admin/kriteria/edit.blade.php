@extends('admin.layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h2 class="fw-bold mb-0" style="color: #26415e;"><img src="{{ asset('assets/logo TI.png') }}" alt="Logo" class="title-logo"> Edit Data Kriteria</h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 25%;" class="fw-bold fs-5 bg-light">Nama Kriteria</th>
                                <td><input type="text" name="nama" class="form-control form-control-lg rounded-3" value="{{ old('nama', $kriteria->nama) }}" required></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Bobot (%)</th>
                                <td><input type="number" name="bobot" class="form-control form-control-lg rounded-3" value="{{ old('bobot', $kriteria->bobot) }}" required></td>
                            </tr>
                            <tr>
                                <th class="fw-bold fs-5 bg-light">Jenis Kriteria</th>
                                <td>
                                    <select name="jenis" class="form-control form-control-lg rounded-3" style="appearance: auto;" required>
                                        <option value="benefit" {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                        <option value="cost" {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>Cost</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.kriteria.index') }}" class="btn rounded-3" style="background-color:#2f5d83; color: white !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
