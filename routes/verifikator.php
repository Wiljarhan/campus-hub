<?php

use App\Http\Controllers\VerifikatorController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Pemilik: Dev3

Route::middleware(['auth', 'role:verifikator'])
    ->prefix('verifikator')
    ->name('verifikator.')
    ->group(function () {
        Route::get('/', [VerifikatorController::class, 'index'])->name('index');
        Route::get('/karya/{karya}', [VerifikatorController::class, 'show'])->name('show');
    });

// SEMENTARA - HAPUS SEBELUM PULL REQUEST
Route::get('/verifikator-dev-login', function () {
    $user = User::where('role', 'verifikator')->firstOrFail();
    Auth::login($user);

    return redirect()->route('verifikator.index');
});
