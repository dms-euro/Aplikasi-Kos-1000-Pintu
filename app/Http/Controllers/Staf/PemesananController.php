<?php

namespace App\Http\Controllers\Staf;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController
{
    public function index()
    {
        $pendingPemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran'])
            ->where('status', 'pending')
            ->whereHas('pembayaran', function($q) {
                $q->where('status', 'pending');
            })
            ->orderBy('created_at', 'desc')
            ->get();
        $confirmedPemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran'])
            ->whereIn('status', ['confirmed', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->get();
        $totalPending = Pemesanan::where('status', 'pending')->count();
        $totalConfirmed = Pemesanan::where('status', 'confirmed')->count();
        $totalCancelled = Pemesanan::where('status', 'cancelled')->count();

        return view('staf.pemesanan', compact(
            'pendingPemesanan',
            'confirmedPemesanan',
            'totalPending',
            'totalConfirmed',
            'totalCancelled'
        ));
    }


    public function confirm($id)
    {
        $pemesanan = Pemesanan::with('kamar')->findOrFail($id);
        if ($pemesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan sudah diproses.');
        }
        $pemesanan->update(['status' => 'confirmed']);
        $pemesanan->kamar->update(['status' => 'terisi']);
        $pembayaran = $pemesanan->pembayaran()->first();
        if ($pembayaran) {
            $pembayaran->update([
                'status' => 'paid',
                'petugas_id' => Auth::id()
            ]);
        }

        return redirect()->back()->with('success', 'Pemesanan berhasil dikonfirmasi.');
    }


    public function cancel(Request $request, $id)
    {
        $pemesanan = Pemesanan::with('kamar')->findOrFail($id);
        if ($pemesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan sudah diproses.');
        }
        $pemesanan->update(['status' => 'cancelled']);
        $pemesanan->kamar->update(['status' => 'tersedia']);
        $pembayaran = $pemesanan->pembayaran()->first();
        if ($pembayaran) {
            $pembayaran->update([
                'status' => 'failed',
                'petugas_id' => Auth::id()
            ]);
        }
        return redirect()->back()->with('success', 'Pemesanan dibatalkan.');
    }
}
