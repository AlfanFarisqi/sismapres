<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin', function () {
    return "Selamat datang Admin. Role Anda: " . session('role');
});

Route::get('/mahasiswa', function () {
    return "Selamat datang Mahasiswa. Role Anda: " . session('role');
});
