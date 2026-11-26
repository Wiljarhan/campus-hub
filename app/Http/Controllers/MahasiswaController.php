<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Kategori;
use App\Models\Lampiran;
use App\Models\PermintaanAdopsi;
use App\Models\UndanganRekrutmen;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    /**
     * Menampilkan halaman form untuk mengunggah karya baru.
     */
    public function create(): View
    {
        // Ambil semua data kategori untuk pilihan dropdown di form
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // Tampilkan view form unggah karya
        return view('mahasiswa.create', compact('kategoris'));
    }

    /**
     * Memvalidasi dan menyimpan karya baru beserta file lampirannya.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input form karya dan file lampiran (maks 5 MB = 5120 KB per file)
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['required', 'string'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'link_demo' => ['nullable', 'url', 'max:255'],
            'link_repo' => ['nullable', 'url', 'max:255'],
            'lampiran' => ['nullable', 'array'],
            'lampiran.*' => ['file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,zip,docx'],
        ]);

        // Simpan data utama karya ke database (isi properti satu per satu agar aman)
        $karya = new Karya();
        $karya->user_id = auth()->id();
        $karya->kategori_id = $validated['kategori_id'];
        $karya->judul = $validated['judul'];
        $karya->ringkasan = $validated['ringkasan'];
        $karya->link_demo = $validated['link_demo'] ?? null;
        $karya->link_repo = $validated['link_repo'] ?? null;
        $karya->status = 'menunggu';
        $karya->save();

        // Jika ada file lampiran yang diunggah, simpan file dan catat ke tabel lampirans
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                // Simpan file fisik ke disk 'public' dalam folder 'lampiran'
                $path = $file->store('lampiran', 'public');

                // Buat record lampiran yang terhubung ke karya ini
                $lampiran = new Lampiran();
                $lampiran->karya_id = $karya->id;
                $lampiran->nama_file = $file->getClientOriginalName();
                $lampiran->path = $path;
                $lampiran->tipe = strtolower($file->getClientOriginalExtension() ?: $file->extension());
                $lampiran->save();
            }
        }

        // Kembali ke halaman daftar karya dengan pesan sukses di session
        return redirect()
            ->route('mahasiswa.index')
            ->with('sukses', 'Karya berhasil diunggah dan sedang menunggu verifikasi.');
    }

    /**
     * Menampilkan daftar permintaan adopsi (UMKM) dan undangan rekrutmen (Recruiter)
     * untuk karya-karya milik mahasiswa yang sedang login.
     */
    public function inbox(): View
    {
        $userId = auth()->id();

        // Ambil permintaan adopsi yang karya-nya dimiliki oleh user yang login
        $permintaanAdopsis = PermintaanAdopsi::with(['karya', 'umkm'])
            ->whereHas('karya', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        // Ambil undangan rekrutmen yang karya-nya dimiliki oleh user yang login
        $undanganRekrutmens = UndanganRekrutmen::with(['karya', 'recruiter'])
            ->whereHas('karya', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        // Kirim kedua daftar ke view resources/views/mahasiswa/inbox.blade.php
        return view('mahasiswa.inbox', compact('permintaanAdopsis', 'undanganRekrutmens'));
    }

    /**
     * Memproses respon mahasiswa (diterima/ditolak) untuk permintaan adopsi.
     */
    public function responAdopsi(Request $request, PermintaanAdopsi $permintaan): RedirectResponse
    {
        return $this->prosesRespon(
            $request,
            $permintaan,
            'Respon permintaan adopsi berhasil disimpan.'
        );
    }

    /**
     * Memproses respon mahasiswa (diterima/ditolak) untuk undangan rekrutmen.
     */
    public function responUndangan(Request $request, UndanganRekrutmen $undangan): RedirectResponse
    {
        return $this->prosesRespon(
            $request,
            $undangan,
            'Respon undangan rekrutmen berhasil disimpan.'
        );
    }

    /**
     * Helper bersama untuk memeriksa kepemilikan karya, memvalidasi status,
     * dan menyimpan respon permintaan adopsi maupun undangan rekrutmen.
     */
    private function prosesRespon(
        Request $request,
        PermintaanAdopsi|UndanganRekrutmen $item,
        string $pesanSukses
    ): RedirectResponse {
        // Wajib cek bahwa karya terkait milik mahasiswa yang sedang login
        if ($item->karya?->user_id !== auth()->id()) {
            abort(403);
        }

        // Validasi status respon: hanya boleh 'diterima' atau 'ditolak'
        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
        ]);

        // Simpan status baru dan arahkan kembali ke halaman inbox
        $item->status = $validated['status'];
        $item->save();

        return redirect()
            ->route('mahasiswa.inbox')
            ->with('sukses', $pesanSukses);
    }
}
