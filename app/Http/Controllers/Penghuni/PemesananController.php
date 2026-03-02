<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Penghuni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController
{
    /**
     * Menampilkan halaman form pemesanan dan pembayaran
     */
    public function create($id)
    {
        $kamar = Kamar::with('tipe_kamar')->findOrFail($id);

        // Cek apakah kamar tersedia
        if ($kamar->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Kamar tidak tersedia untuk disewa.');
        }

        // Cek apakah user adalah penghuni
        $user = Auth::user();
        $penghuni = Penghuni::where('users_id', $user->id)->first();

        if (!$penghuni) {
            return redirect()->route('profile.edit')->with('error', 'Lengkapi data penghuni terlebih dahulu.');
        }

        return view('penghuni.pemesanan', compact('kamar', 'penghuni'));
    }

    /**
     * Menyimpan data pemesanan
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'durasi_bulanan' => 'required|integer|min:1|max:24',
        ]);

        $kamar = Kamar::with('tipe_kamar')->findOrFail($request->kamar_id);

        // Cek kembali status kamar
        if ($kamar->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Kamar sudah tidak tersedia.');
        }

        // Hitung tanggal keluar
        $tanggalMasuk = Carbon::parse($request->tanggal_masuk);
        $tanggalKeluar = $tanggalMasuk->copy()->addMonths((int) $request->durasi_bulanan);

        // Hitung total harga
        $hargaPerBulan = $kamar->tipe_kamar->harga;
        $total = $hargaPerBulan * $request->durasi_bulanan;

        // Dapatkan data penghuni dari user yang login
        $user = Auth::user();
        $penghuni = Penghuni::where('users_id', $user->id)->first();

        $pemesananAktif = Pemesanan::where('penghuni_id', $penghuni->id)
            ->whereIn('status', ['pending', 'dipesan', 'aktif'])
            ->where('tanggal_keluar', '>=', now())
            ->exists();

        if ($pemesananAktif) {
            return redirect()->back()->with('error','Anda masih memiliki kamar aktif. Selesaikan atau tunggu masa sewa habis.');
        }

        // Buat pemesanan baru
        $pemesanan = Pemesanan::create([
            'penghuni_id' => $penghuni->id,
            'kamar_id' => $kamar->id,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => $tanggalKeluar,
            'durasi_bulanan' => $request->durasi_bulanan,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Update status kamar menjadi 'dipesan'
        $kamar->update(['status' => 'dipesan']);

        // Redirect ke halaman detail pemesanan
        return redirect()->route('penghuni.pemesanan.show', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan detail pemesanan dan form pembayaran
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['kamar.tipe_kamar', 'penghuni', 'pembayaran'])
            ->findOrFail($id);

        // Cek otorisasi (hanya pemilik pemesanan yang bisa melihat)
        $user = Auth::user();
        $penghuni = Penghuni::where('users_id', $user->id)->first();

        if ($pemesanan->penghuni_id !== $penghuni->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('penghuni.pemesanan_show', compact('pemesanan'));
    }

    // /**
    //  * Menyimpan data pembayaran
    //  */
    // public function storePembayaran(Request $request, $pemesanan_id)
    // {
    //     $request->validate([
    //         'metode_pembayaran' => 'required|in:tunai,transfer',
    //         'bukti_bayar' => 'required_if:metode_pembayaran,transfer|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $pemesanan = Pemesanan::findOrFail($pemesanan_id);

    //     // Cek apakah sudah ada pembayaran sebelumnya
    //     if ($pemesanan->pembayaran()->exists()) {
    //         return redirect()->back()->with('error', 'Pembayaran sudah pernah dilakukan.');
    //     }

    //     $dataPembayaran = [
    //         'pemesanan_id' => $pemesanan->id,
    //         'tanggal_bayar' => now(),
    //         'jumlah' => $pemesanan->total,
    //         'status' => 'pending',
    //     ];

    //     // Jika metode transfer, upload bukti bayar
    //     if ($request->metode_pembayaran === 'transfer') {
    //         $path = $request->file('bukti_bayar')->store('bukti-pembayaran', 'public');
    //         $dataPembayaran['bukti_bayar'] = $path;
    //     }

    //     // Simpan pembayaran
    //     Pembayaran::create($dataPembayaran);

    //     $message = $request->metode_pembayaran === 'tunai'
    //         ? 'Pembayaran akan diverifikasi oleh petugas.'
    //         : 'Bukti pembayaran berhasil diupload. Menunggu verifikasi petugas.';

    //     return redirect()->route('pemesanan.show', $pemesanan->id)
    //         ->with('success', $message);
    // }
}
