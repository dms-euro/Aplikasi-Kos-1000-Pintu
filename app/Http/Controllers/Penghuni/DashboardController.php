<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil hanya kamar tersedia + eager loading
        $kamar = Kamar::with('tipe_kamar')
                    ->where('status', 'tersedia')
                    ->latest()
                    ->get();

        $kategori = Tipe_kamar::all();

        return view('penghuni.dashboard', compact('kamar', 'kategori'));
    }

    public function show($id)
    {
        $kamar = Kamar::with('tipe_kamar')->findOrFail($id);

        return view('penghuni.detail-kamar', compact('kamar'));
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
