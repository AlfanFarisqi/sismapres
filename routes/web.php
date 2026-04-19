<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/mahasiswa', function () { return view('admin.mahasiswa.index'); })->name('mahasiswa.index');
        Route::get('/kriteria', function () { return view('admin.kriteria.index'); })->name('kriteria.index');
        Route::get('/data-penilaian', function () { return view('admin.data-penilaian.input'); })->name('data-penilaian.input');
        Route::get('/upload-berkas', function () { return view('admin.upload-berkas.index'); })->name('upload-berkas.index');
        Route::get('/hasil-seleksi', function () { return view('admin.hasil-seleksi.index'); })->name('hasil-seleksi.index');
        Route::get('/manajemen-user', function () { return view('admin.manajemen-user.index'); })->name('manajemen-user.index');
    });

    Route::get('/mahasiswa/dashboard', function () {
        return "Selamat datang Mahasiswa. Role Anda: " . auth()->user()->role;
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
