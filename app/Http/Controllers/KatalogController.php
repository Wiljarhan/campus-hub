<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Halaman Beranda
    public function beranda()
    {
        $karyaTerbaru = Karya::with(['mahasiswa', 'kategori'])
            ->where('status', 'terverifikasi')
            ->latest()
            ->take(6)
            ->get();

        $totalKarya = Karya::where('status', 'terverifikasi')
            ->count();

        return view('publik.beranda', compact(
            'karyaTerbaru',
            'totalKarya'
        ));
    }

    // Halaman Katalog
    public function katalog(Request $request)
    {
        $query = Karya::with(['mahasiswa', 'kategori'])
            ->where('status', 'terverifikasi');

        if ($request->filled('cari')) {
            $query->where(
                'judul',
                'like',
                '%' . $request->cari . '%'
            );
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $karyas = $query->latest()
            ->paginate(9)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('publik.katalog', compact(
            'karyas',
            'kategoris'
        ));
    }

    // Halaman Detail Karya
    public function detail($id)
    {
        $karya = Karya::with([
            'mahasiswa',
            'kategori',
            'lampirans',
            'verifikasi'
        ])
            ->where('status', 'terverifikasi')
            ->findOrFail($id);

        $karyaLainnya = Karya::with([
            'mahasiswa',
            'kategori'
        ])
            ->where('status', 'terverifikasi')
            ->where('id', '!=', $karya->id)
            ->latest()
            ->take(3)
            ->get();

        return view('publik.detail-karya', compact(
            'karya',
            'karyaLainnya'
        ));
    }
}
