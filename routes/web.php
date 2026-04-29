<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaDashboardController;

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
        Route::get('/profile', [MahasiswaDashboardController::class, 'showProfile'])->name('profile');
        Route::post('/profile', [MahasiswaDashboardController::class, 'updateProfile'])->name('profile.update');
        
        Route::post('/upload-foto', [\App\Http\Controllers\ProfileController::class, 'uploadFoto'])->name('upload-foto');
        
        Route::get('/berkas', [MahasiswaDashboardController::class, 'showBerkas'])->name('berkas.index');
        Route::post('/berkas', [MahasiswaDashboardController::class, 'storeBerkas'])->name('berkas.store');
        
        Route::get('/penilaian', [MahasiswaDashboardController::class, 'showPenilaian'])->name('penilaian.index');
        Route::get('/penilaian-data', [MahasiswaDashboardController::class, 'getPenilaian'])->name('penilaian.data');
        
        Route::get('/hasil', [MahasiswaDashboardController::class, 'showHasil'])->name('hasil.index');
        Route::get('/hasil-data', [MahasiswaDashboardController::class, 'getHasilSeleksi'])->name('hasil.data');

        Route::get('/informasi', function () {
            return view('mahasiswa.informasi');
        })->name('informasi');
        
        Route::get('/pengumuman', function () {
            return view('mahasiswa.pengumuman');
        })->name('pengumuman');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
