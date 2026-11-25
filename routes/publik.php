<?php

use Illuminate\Support\Facades\Route;

// Pemilik: PO

Route::get('/', function () {
    return view('publik.beranda');
});
