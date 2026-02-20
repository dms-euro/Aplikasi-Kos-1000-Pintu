<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalKamar = Kamar::count();
        $Tersedia = Kamar::where('status', 'tersedia')->count();
        $Terisi = Kamar::where('status', 'terisi')->count();
        $Perbaikan = Kamar::where('status', 'perbaikan')->count();
        $tipe = Tipe_kamar::all();
        $kamar = Kamar::with('tipe_kamar')->get();
        return view('admin.kamar', compact('tipe', 'kamar', 'totalKamar', 'Tersedia', 'Terisi', 'Perbaikan'));
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
        $validated = $request->validate(
            [
                'tipe_kamar_id' => 'required',
                'kode_kamar' => 'required|unique:kamar,kode_kamar',
                'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required',
            ],
            [
                'kode_kamar.unique' => 'Kode kamar sudah digunakan!',
            ]
        );

        if ($request->hasFile('foto_kamar')) {
            $validated['foto_kamar'] = $request->file('foto_kamar')->store('foto_kamar', 'public');
        }


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
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate(
            [
                'tipe_kamar_id' => 'required',
                'kode_kamar' => 'required|unique:kamar,kode_kamar,' . $id,
                'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required',
            ],
            [
                'kode_kamar.unique' => 'Kode kamar sudah digunakan!',
            ]
        );

        if ($request->hasFile('foto_kamar')) {
            if ($kamar->foto_kamar) {
                Storage::disk('public')->delete($kamar->foto_kamar);
            }

            $validated['foto_kamar'] = $request->file('foto_kamar')->store('foto_kamar', 'public');
        }

        $kamar->update($validated);

        return redirect()->back()->with('success', 'Kamar Diedite');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);

        if ($kamar->foto_kamar) {
            Storage::disk('public')->delete($kamar->foto_kamar);
        }

        $kamar->delete();

        return redirect()->back()->with('success', 'Data Kamar Telah Dihapus');
    }
}
