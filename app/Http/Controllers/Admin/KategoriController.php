<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class KategoriController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Tipe_kamar::all();
        return view('admin.kategori', compact('kategori'));
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
            'tipe' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        Tipe_kamar::create($validated);

        return redirect()->back()->with('success', 'Tipe Kamar Bru Ditambahkan');
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
        $validated = $request->validate([
            'tipe' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        $tipe = Tipe_kamar::findOrFail($id);

        $tipe->update($validated);

        return redirect()->back()->with('success', 'Tipe Kamar Bru Diedite');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Tipe_kamar::findOrFail($id);

        if ($kategori->kamar()->count() > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena masih digunakan oleh kamar.');
        }

        $kategori->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
