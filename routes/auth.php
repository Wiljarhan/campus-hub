<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Pemilik: Dev1

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/akun', [AuthController::class, 'akun'])->name('akun');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
