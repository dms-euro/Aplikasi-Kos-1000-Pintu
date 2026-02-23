<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class SewaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar'])->paginate(10);

        $totalPenyewaan = Pemesanan::count();
        $aktif = Pemesanan::where('status', 'aktif')->count();
        $pending = Pemesanan::where('status', 'pending')->count();
        $selesai = Pemesanan::where('status', 'selesai')->count();
        $batal = Pemesanan::where('status', 'batal')->count();

        $totalPendapatan = Pemesanan::whereIn('status', ['aktif', 'selesai'])->sum('total');
        $pendapatanBulanIni = Pemesanan::whereIn('status', ['aktif', 'selesai'])
            ->whereMonth('created_at', now()->month)
            ->sum('total');
        $pendapatanTahunIni = Pemesanan::whereIn('status', ['aktif', 'selesai'])
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $total = max($totalPenyewaan, 1); // hindari division by zero
        $aktifPersen = round(($aktif / $total) * 100);
        $pendingPersen = round(($pending / $total) * 100);
        $selesaiPersen = round(($selesai / $total) * 100);
        $batalPersen = round(($batal / $total) * 100);

        return view('admin.pemesanan', compact(
            'penyewaan',
            'totalPenyewaan',
            'aktif',
            'pending',
            'selesai',
            'batal',
            'totalPendapatan',
            'pendapatanBulanIni',
            'pendapatanTahunIni',
            'aktifPersen',
            'pendingPersen',
            'selesaiPersen',
            'batalPersen'
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
