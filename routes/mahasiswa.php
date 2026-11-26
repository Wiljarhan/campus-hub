<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Pemilik: Dev2

// Grup route khusus mahasiswa yang sudah login dan memiliki role "mahasiswa"
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->group(function () {
        // Menampilkan daftar karya milik mahasiswa yang sedang login (URL: /mahasiswa)
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    });
