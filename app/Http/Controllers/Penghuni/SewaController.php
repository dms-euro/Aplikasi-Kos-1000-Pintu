<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SewaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $kamar_id)
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        $kamar = Kamar::with('tipe_kamar')->findOrFail($kamar_id);

        // ❗ Cek kamar masih tersedia
        if ($kamar->status !== 'tersedia') {
            return back()->with('error', 'Kamar sudah terisi.');
        }

        // ❗ Batasi 1 penghuni hanya boleh 1 kamar aktif
        $cekSewa = Pemesanan::where('penghuni_id', $penghuni->id)
            ->where('status', 'aktif')
            ->exists();

        if ($cekSewa) {
            return back()->with('error', 'Anda masih memiliki kamar aktif.');
        }

        $request->validate([
            'tanggal_masuk' => 'required|date',
            'durasi_bulanan' => 'required|integer|min:1'
        ]);

        $harga = $kamar->tipe_kamar->harga;
        $durasi = $request->durasi_bulanan;

        $total = $harga * $durasi;

        $tanggal_keluar = date(
            'Y-m-d',
            strtotime("+$durasi month", strtotime($request->tanggal_masuk))
        );

        // ✅ Simpan pemesanan
        Pemesanan::create([
            'penghuni_id' => $penghuni->id,
            'kamar_id' => $kamar->id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $tanggal_keluar,
            'durasi_bulanan' => $durasi,
            'total' => $total,
            'status' => 'pending',
        ]);

        // ✅ Update status kamar
        $kamar->update([
            'status' => 'terisi'
        ]);

        return redirect('/')
            ->with('success', 'Berhasil menyewa kamar!');
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
