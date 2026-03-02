<?php

namespace App\Http\Controllers\Staf;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class KamarController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::with('tipe_kamar');

        if ($request->filled('tipe')) {
            $query->where('tipe_kamar_id', $request->tipe);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $kamar = $query->orderBy('kode_kamar')->get();
        $tipe_kamar = Tipe_kamar::all();

        // Statistik
        $totalKamar = Kamar::count();
        $tersedia = Kamar::where('status', 'tersedia')->count();
        $dipesan = Kamar::where('status', 'dipesan')->count();
        $terisi = Kamar::where('status', 'terisi')->count();
        $perbaikan = Kamar::where('status', 'perbaikan')->count();

        return view('staf.kamar', compact(
            'kamar',
            'tipe_kamar',
            'totalKamar',
            'tersedia',
            'dipesan',
            'terisi',
            'perbaikan'
        ));
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
        //
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
