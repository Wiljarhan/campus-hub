<?php

use App\Http\Controllers\EksternalController;
use Illuminate\Support\Facades\Route;

// Pemilik: Dev4

Route::middleware('auth')
    ->prefix('eksternal')
    ->name('eksternal.')
    ->group(function () {
        Route::get('/riwayat', [EksternalController::class, 'riwayat'])
            ->middleware('role:umkm,recruiter')
            ->name('riwayat');

        Route::post('/adopsi/{karya}', [EksternalController::class, 'storeAdopsi'])
            ->middleware('role:umkm')
            ->name('adopsi.store');

        Route::post('/undangan/{karya}', [EksternalController::class, 'storeUndangan'])
            ->middleware('role:recruiter')
            ->name('undangan.store');
    });
