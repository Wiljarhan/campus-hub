<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\PermintaanAdopsi;
use App\Models\UndanganRekrutmen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EksternalController extends Controller
{
    /**
     * Store a new adoption request from a UMKM user for a verified karya.
     */
    public function storeAdopsi(Request $request, Karya $karya): RedirectResponse
    {
        if ($redirect = $this->guardKaryaTerverifikasi($karya)) {
            return $redirect;
        }

        $validated = $request->validate([
            'pesan' => ['required', 'string', 'max:1000'],
        ]);

        PermintaanAdopsi::create([
            'karya_id' => $karya->id,
            'umkm_id' => Auth::id(),
            'pesan' => $validated['pesan'],
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Permintaan adopsi berhasil dikirim.');
    }

    /**
     * Store a new recruitment invitation from a recruiter for the owner of a verified karya.
     */
    public function storeUndangan(Request $request, Karya $karya): RedirectResponse
    {
        if ($redirect = $this->guardKaryaTerverifikasi($karya)) {
            return $redirect;
        }

        $validated = $request->validate([
            'posisi' => ['required', 'string', 'max:255'],
            'pesan' => ['required', 'string', 'max:1000'],
        ]);

        UndanganRekrutmen::create([
            'karya_id' => $karya->id,
            'recruiter_id' => Auth::id(),
            'mahasiswa_id' => $karya->user_id,
            'posisi' => $validated['posisi'],
            'pesan' => $validated['pesan'],
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Undangan rekrutmen berhasil dikirim.');
    }

    /**
     * Ensure the target karya is verified before accepting external actions.
     */
    private function guardKaryaTerverifikasi(Karya $karya): ?RedirectResponse
    {
        if ($karya->status !== 'terverifikasi') {
            return back()->with('error', 'Aksi ini hanya dapat dilakukan pada karya yang berstatus terverifikasi.');
        }

        return null;
    }
}
