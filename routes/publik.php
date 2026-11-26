<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;

// Pemilik: PO

Route::get('/', [KatalogController::class, 'beranda']);

Route::get('/katalog', [KatalogController::class, 'katalog']);

Route::get('/karya/{id}', [KatalogController::class, 'detail'])
    ->name('publik.karya.detail');