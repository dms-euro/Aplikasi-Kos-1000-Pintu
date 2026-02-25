<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Pemesanan;
use Carbon\Carbon;
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
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'durasi_bulanan' => 'required|integer|min:1'
        ]);

        $kamar = Kamar::findOrFail($kamar_id);

        // Cegah kalau kamar tidak tersedia
        if ($kamar->status != 'tersedia') {
            return back()->with('error', 'Kamar tidak tersedia');
        }

        // $penghuni = auth()->user()->penghuni;

        $tanggal_keluar = Carbon::parse($request->tanggal_masuk)
            ->addMonths((int) $request->durasi_bulanan);

        $harga_per_bulan = $kamar->tipe_kamar->harga;

        $total = $harga_per_bulan * (int) $request->durasi_bulanan;

        // Buat pemesanan
        $pemesanan = Pemesanan::create([
            // 'penghuni_id' => $penghuni->id,
            'kamar_id' => $kamar->id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $tanggal_keluar,
            'durasi_bulanan' => $request->durasi_bulanan,
            'total' => $total,
            'status' => 'pending', // sesuaikan enum kamu
        ]);

        // 🔥 UBAH STATUS KAMAR JADI DIPESAN
        $kamar->update([
            'status' => 'dipesan'
        ]);

        return redirect()->route('pembayaran.form', $pemesanan->id);
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
