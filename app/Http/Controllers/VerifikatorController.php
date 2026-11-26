<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Verifikasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VerifikatorController extends Controller
{
    /**
     * Display a listing of karya awaiting verification.
     */
    public function index(): View
    {
        $karyas = Karya::with(['mahasiswa', 'kategori'])
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        return view('verifikator.index', compact('karyas'));
    }

    /**
     * Display the specified karya details for verification.
     */
    public function show(Karya $karya): View
    {
        $karya->load(['mahasiswa', 'kategori', 'lampirans']);

        return view('verifikator.show', compact('karya'));
    }

    /**
     * Approve the specified karya after verification.
     */
    public function setujui(Karya $karya): RedirectResponse
    {
        if ($karya->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Karya ini sudah diputuskan sebelumnya.');
        }

        return $this->simpanKeputusan(
            $karya,
            'terverifikasi',
            null,
            'Karya berhasil disetujui.'
        );
    }

    /**
     * Reject the specified karya with revision notes.
     */
    public function tolak(Request $request, Karya $karya): RedirectResponse
    {
        if ($karya->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Karya ini sudah diputuskan sebelumnya.');
        }

        $validated = $request->validate([
            'catatan' => ['required', 'string', 'min:10', 'max:1000'],
        ], [
            'catatan.required' => 'Catatan revisi wajib diisi',
            'catatan.string' => 'Catatan revisi harus berupa teks',
            'catatan.min' => 'Catatan revisi minimal 10 karakter',
            'catatan.max' => 'Catatan revisi maksimal 1000 karakter',
        ]);

        return $this->simpanKeputusan(
            $karya,
            'ditolak',
            $validated['catatan'],
            'Karya ditolak, catatan revisi terkirim ke mahasiswa.'
        );
    }

    /**
     * Persist the verification decision and update the karya status atomically.
     */
    private function simpanKeputusan(
        Karya $karya,
        string $hasil,
        ?string $catatan,
        string $successMessage
    ): RedirectResponse {
        DB::transaction(function () use ($karya, $hasil, $catatan) {
            Verifikasi::create([
                'karya_id' => $karya->id,
                'verifikator_id' => auth()->id(),
                'hasil' => $hasil,
                'catatan' => $catatan,
            ]);

            $karya->update([
                'status' => $hasil,
            ]);
        });

        return redirect()
            ->route('verifikator.index')
            ->with('success', $successMessage);
    }
}
