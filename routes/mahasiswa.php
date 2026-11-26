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

        // Menampilkan form unggah karya baru (URL: /mahasiswa/karya/create)
        Route::get('/karya/create', [MahasiswaController::class, 'create'])->name('mahasiswa.karya.create');

        // Menyimpan karya baru beserta file lampirannya (URL: /mahasiswa/karya)
        Route::post('/karya', [MahasiswaController::class, 'store'])->name('mahasiswa.karya.store');

        // Menampilkan halaman inbox permintaan adopsi dan undangan rekrutmen (URL: /mahasiswa/inbox)
        Route::get('/inbox', [MahasiswaController::class, 'inbox'])->name('mahasiswa.inbox');

        // Memproses respon mahasiswa (terima/tolak) untuk permintaan adopsi dari UMKM
        Route::patch('/adopsi/{permintaan}/respon', [MahasiswaController::class, 'responAdopsi'])
            ->name('mahasiswa.adopsi.respon');

        // Memproses respon mahasiswa (terima/tolak) untuk undangan rekrutmen dari Recruiter
        Route::patch('/undangan/{undangan}/respon', [MahasiswaController::class, 'responUndangan'])
            ->name('mahasiswa.undangan.respon');
    });
