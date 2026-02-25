<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SewaController
{

    /**
     * Menampilkan daftar pemesanan yang perlu dikonfirmasi
     */
    public function index()
    {
        $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pemesanan', compact('pemesanan'));
    }

    /**
     * Menampilkan detail pemesanan
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran'])
            ->findOrFail($id);

        return view('staf.detail-sewa', compact('pemesanan'));
    }

    /**
     * Mengkonfirmasi pesanan (sudah dibayar)
     */
    public function confirm(Request $request, $id)
    {
        $pemesanan = Pemesanan::with('kamar')->findOrFail($id);

        if ($pemesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan sudah diproses sebelumnya.');
        }

        // Validasi apakah sudah ada pembayaran
        $pembayaran = $pemesanan->pembayaran()->latest()->first();

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Belum ada data pembayaran untuk pemesanan ini.');
        }

        // Update status pemesanan menjadi confirmed
        $pemesanan->update([
            'status' => 'confirmed',
        ]);

        // Update status kamar menjadi terisi
        $pemesanan->kamar->update([
            'status' => 'terisi',
        ]);

        // Update pembayaran dengan petugas yang mengkonfirmasi
        $pembayaran->update([
            'petugas_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Pemesanan berhasil dikonfirmasi. Kamar sekarang berstatus terisi.');
    }

    /**
     * Membatalkan pesanan (jika belum bayar atau ada masalah)
     */
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $pemesanan = Pemesanan::with('kamar')->findOrFail($id);

        if ($pemesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan sudah diproses sebelumnya.');
        }

        // Update status pemesanan menjadi cancelled
        $pemesanan->update([
            'status' => 'cancelled',
        ]);

        // Update status kamar kembali menjadi tersedia
        $pemesanan->kamar->update([
            'status' => 'tersedia',
        ]);

        // Catat alasan pembatalan (bisa disimpan di tabel tersendiri jika perlu)

        return redirect()->back()->with('success', 'Pemesanan dibatalkan. Kamar kembali tersedia.');
    }

    /**
     * Menampilkan riwayat pemesanan yang sudah dikonfirmasi
     */
    // public function history()
    // {
    //     $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipeKamar', 'pembayaran.petugas'])
    //         ->whereIn('status', ['confirmed', 'cancelled'])
    //         ->orderBy('updated_at', 'desc')
    //         ->paginate(10);

    //     return view('petugas.konfirmasi.history', compact('pemesanan'));
    // }
}
