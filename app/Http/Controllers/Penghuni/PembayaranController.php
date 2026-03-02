<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController
{
    public function cash($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Cek apakah sudah ada pembayaran
        if ($pemesanan->pembayaran()->exists()) {
            return redirect()->back()->with('error', 'Pembayaran sudah pernah dilakukan.');
        }

        // Buat pembayaran dengan status pending
        Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'tanggal_bayar' => now(),
            'jumlah' => $pemesanan->total,
            'status' => 'pending',
            'bukti_bayar' => null,
        ]);

        return redirect()->back()->with('success', 'Pembayaran cash berhasil dicatat. Silakan datang ke kasir untuk menyelesaikan pembayaran.');
    }

    /**
     * Proses pembayaran QRIS dengan upload bukti
     */
    public function qris(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        // Cek apakah sudah ada pembayaran
        if ($pemesanan->pembayaran()->exists()) {
            return redirect()->back()->with('error', 'Pembayaran sudah pernah dilakukan.');
        }

        // Upload bukti bayar
        $path = $request->file('bukti_bayar')->store('bukti-pembayaran', 'public');

        // Buat pembayaran
        Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'tanggal_bayar' => now(),
            'jumlah' => $pemesanan->total,
            'status' => 'pending',
            'bukti_bayar' => $path,
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi petugas.');
    }
}
