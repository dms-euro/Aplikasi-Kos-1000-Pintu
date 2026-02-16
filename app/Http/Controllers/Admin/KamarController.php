<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class KamarController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe = Tipe_kamar::all();
        $kamar = Kamar::with('tipe_kamar')->latest()->get();
        return view('admin.kamar', compact('tipe', 'kamar'));
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
        $validated = $request->validate([
            'tipe_kamar_id' => 'required',
            'kode_kamar' => 'required',
            'status' => 'required',
        ]);

        Kamar::create($validated);

        return redirect()->back()->with('success', 'Kamar Berhasil Terdaftar');
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
