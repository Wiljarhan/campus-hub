<?php

namespace App\Http\Controllers;

use App\Models\Karya;
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
}
