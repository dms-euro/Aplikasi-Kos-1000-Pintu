<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::with('tipe_kamar');
        if ($request->search) {
            $query->where('kode_kamar', 'like', '%' . $request->search . '%');
        }
        if ($request->tipe) {
            $query->where('tipe_kamar_id', $request->tipe);
        }
        $Kamar = $query->paginate(12);
        $TipeKamar = Tipe_kamar::all();
        return view('penghuni.kamar', compact('Kamar', 'TipeKamar'));
    }

    public function saya(Request $request)
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;
        if (!$penghuni) {
            return redirect()->route('profile.edit')
                ->with('error', 'Lengkapi data penghuni terlebih dahulu.');
        }
        $pemesanan = Pemesanan::with(['kamar.tipe_kamar', 'pembayaran'])
            ->where('penghuni_id', $penghuni->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('penghuni.kamar_saya', compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = Kamar::with('tipe_kamar')->findOrFail($id);
        return view('penghuni.kamar_detail', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
