<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\HasilController;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/mahasiswa', [AdminController::class, 'mahasiswa'])->name('mahasiswa.index');
        
        // Kriteria Routes
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        Route::get('/data-penilaian', [AdminController::class, 'dataPenilaian'])->name('data-penilaian.input');
        Route::get('/upload-berkas', [AdminController::class, 'uploadBerkas'])->name('upload-berkas.index');
        Route::get('/hasil-seleksi', [AdminController::class, 'hasilSeleksi'])->name('hasil-seleksi.index');
        Route::post('/hasil-seleksi/calculate', [HasilController::class, 'calculate'])->name('hasil-seleksi.calculate');
        Route::get('/hasil-seleksi/data', [HasilController::class, 'index'])->name('hasil-seleksi.data');
        Route::get('/manajemen-user', [AdminController::class, 'manajemenUser'])->name('manajemen-user.index');
    });

    Route::get('/mahasiswa/dashboard', function () {
        return "Selamat datang Mahasiswa. Role Anda: " . auth()->user()->role;
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
