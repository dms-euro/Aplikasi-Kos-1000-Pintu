<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController
{
    public function form($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('penghuni.pembayaran', compact('pemesanan'));
    }
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
    public function store(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $jumlah = str_replace('.', '', $request->jumlah);

        Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'tanggal_bayar' => now(),
            'jumlah' => $jumlah,
            'petugas_id' => null,
        ]);

        return redirect()->route('dashboard.penghuni')
            ->with('success', 'Pembayaran dikirim, menunggu verifikasi admin');
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
