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
}
