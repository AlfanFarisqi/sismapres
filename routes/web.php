<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfile;
use App\Http\Controllers\Mahasiswa\BerkasController as MahasiswaBerkas;
use App\Http\Controllers\Mahasiswa\PenilaianController as MahasiswaPenilaian;
use App\Http\Controllers\Mahasiswa\HasilController as MahasiswaHasil;
use App\Http\Controllers\Mahasiswa\InformasiController as MahasiswaInformasi;
use App\Http\Controllers\Mahasiswa\PengumumanController as MahasiswaPengumuman;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::middleware(['auth'])->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // Mahasiswa Routes
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
        Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
        
        // Kriteria Routes
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        Route::get('/data-penilaian', [App\Http\Controllers\PenilaianController::class, 'index'])->name('data-penilaian.input');
        Route::post('/data-penilaian', [App\Http\Controllers\PenilaianController::class, 'store'])->name('data-penilaian.store');
        Route::get('/upload-berkas', [AdminController::class, 'uploadBerkas'])->name('upload-berkas.index');
        Route::post('/upload-berkas/verifikasi/{mahasiswa}', [AdminController::class, 'verifikasiBerkas'])->name('upload-berkas.verifikasi');
        Route::get('/hasil-seleksi', [AdminController::class, 'hasilSeleksi'])->name('hasil-seleksi.index');
        Route::post('/hasil-seleksi/calculate', [HasilController::class, 'calculate'])->name('hasil-seleksi.calculate');
        Route::get('/hasil-seleksi/data', [HasilController::class, 'index'])->name('hasil-seleksi.data');
        Route::get('/manajemen-user', [AdminController::class, 'manajemenUser'])->name('manajemen-user.index');
    });

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/profile', [MahasiswaProfile::class, 'index'])->name('profile');
        Route::post('/profile', [MahasiswaProfile::class, 'update'])->name('profile.update');
        
        Route::post('/upload-foto', [MahasiswaProfile::class, 'uploadFoto'])->name('upload-foto');
        
        Route::get('/berkas', [MahasiswaBerkas::class, 'index'])->name('berkas.index');
        Route::post('/berkas', [MahasiswaBerkas::class, 'store'])->name('berkas.store');
        
        Route::get('/penilaian', [MahasiswaPenilaian::class, 'index'])->name('penilaian.index');
        Route::post('/penilaian', [MahasiswaPenilaian::class, 'store'])->name('penilaian.store');
        Route::get('/penilaian-data', [MahasiswaPenilaian::class, 'data'])->name('penilaian.data');
        
        Route::get('/hasil', [MahasiswaHasil::class, 'index'])->name('hasil.index');
        Route::get('/hasil-data', [MahasiswaHasil::class, 'data'])->name('hasil.data');

        Route::get('/informasi', [MahasiswaInformasi::class, 'index'])->name('informasi');
        
        Route::get('/pengumuman', [MahasiswaPengumuman::class, 'index'])->name('pengumuman');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
