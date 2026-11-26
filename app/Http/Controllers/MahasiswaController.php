<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use Illuminate\Contracts\View\View;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman daftar karya milik mahasiswa yang sedang login.
     */
    public function index(): View
    {
        // Ambil semua karya milik user yang sedang login,
        // muat relasi kategori dan verifikasi sekaligus (eager loading),
        // lalu urutkan dari karya yang paling baru
        $karyas = Karya::with(['kategori', 'verifikasi'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // Kirim data karya ke view resources/views/mahasiswa/index.blade.php
        return view('mahasiswa.index', compact('karyas'));
    }
}
