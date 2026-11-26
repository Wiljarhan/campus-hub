<?php

use App\Http\Controllers\VerifikatorController;
use Illuminate\Support\Facades\Route;

// Pemilik: Dev3

Route::middleware(['auth', 'role:verifikator'])
    ->prefix('verifikator')
    ->name('verifikator.')
    ->group(function () {
        Route::get('/', [VerifikatorController::class, 'index'])->name('index');
        Route::get('/karya/{karya}', [VerifikatorController::class, 'show'])->name('show');
        Route::post('/karya/{karya}/setujui', [VerifikatorController::class, 'setujui'])->name('setujui');
        Route::post('/karya/{karya}/tolak', [VerifikatorController::class, 'tolak'])->name('tolak');
    });
