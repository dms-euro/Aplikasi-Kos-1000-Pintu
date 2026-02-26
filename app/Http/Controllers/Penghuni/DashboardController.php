<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Routing\Controller as RoutingController;

class DashboardController extends RoutingController
{
    public function index()
    {
        // Statistik Penghuni
        $penghuniAktif = Penghuni::whereHas('pemesanan', function ($q) {
            $q->where('status', 'confirmed')
                ->where('tanggal_masuk', '<=', now())
                ->where('tanggal_keluar', '>=', now());
        })->count();

        $penghuniBaru = Penghuni::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Statistik Kamar
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarDipesan = Kamar::where('status', 'dipesan')->count();
        $kamarPerbaikan = Kamar::where('status', 'perbaikan')->count();

        // Persentase untuk progress bar
        $persenTerisi = $totalKamar > 0 ? round(($kamarTerisi / $totalKamar) * 100) : 0;
        $persenTersedia = $totalKamar > 0 ? round(($kamarTersedia / $totalKamar) * 100) : 0;
        $persenDipesan = $totalKamar > 0 ? round(($kamarDipesan / $totalKamar) * 100) : 0;
        $persenPerbaikan = $totalKamar > 0 ? round(($kamarPerbaikan / $totalKamar) * 100) : 0;

        // Pemesanan
        $pemesananPending = Pemesanan::where('status', 'pending')->count();
        $pemesananTerbaru = Pemesanan::with(['penghuni', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pembayaran
        $pendingVerifikasi = Pembayaran::where('status', 'pending')->count();
        $pembayaranPending = Pembayaran::with(['pemesanan.penghuni', 'pemesanan.kamar'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pemasukan Hari Ini
        $pemasukanHariIni = Pembayaran::whereDate('tanggal_bayar', now())
            ->where('status', 'paid')
            ->sum('jumlah');

        $transaksiHariIni = Pembayaran::whereDate('tanggal_bayar', now())
            ->where('status', 'paid')
            ->count();

        // Aktivitas Terkini (gabungan)
        $aktivitas = collect();

        // Pembayaran baru
        $pembayaranBaru = Pembayaran::with('pemesanan.penghuni')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Pembayaran ' . ($item->pemesanan->penghuni->nama ?? 'penghuni') . ' sebesar Rp ' . number_format($item->jumlah, 0, ',', '.'),
                    'waktu' => $item->created_at->diffForHumans(),
                    'tipe' => 'pembayaran',
                    'link' => route('staf.verifikasi.show', $item->id)
                ];
            });

        // Pemesanan baru
        $pemesananBaru = Pemesanan::with('penghuni')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Pemesanan baru dari ' . ($item->penghuni->nama ?? 'penghuni'),
                    'waktu' => $item->created_at->diffForHumans(),
                    'tipe' => 'pemesanan',
                    'link' => route('staf.pemesanan.show', $item->id)
                ];
            });

        // Penghuni baru
        $penghuniBaruData = Penghuni::orderBy('created_at', 'desc')
            ->limit(2)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Penghuni baru: ' . $item->nama,
                    'waktu' => $item->created_at->diffForHumans(),
                    'tipe' => 'penghuni',
                    'link' => route('staf.penghuni.show', $item->id)
                ];
            });

        $aktivitas = $pembayaranBaru->concat($pemesananBaru)->concat($penghuniBaruData)
            ->sortByDesc(function ($item) {
                // Sorting manual berdasarkan waktu
                return strtotime(str_replace(
                    ['detik', 'menit', 'jam', 'hari', 'bulan', 'tahun'],
                    ['second', 'minute', 'hour', 'day', 'month', 'year'],
                    $item->waktu
                ));
            })
            ->take(5)
            ->values();

        return view('staf.dashboard', compact(
            'penghuniAktif',
            'penghuniBaru',
            'totalKamar',
            'kamarTerisi',
            'kamarTersedia',
            'kamarDipesan',
            'kamarPerbaikan',
            'persenTerisi',
            'persenTersedia',
            'persenDipesan',
            'persenPerbaikan',
            'pemesananPending',
            'pemesananTerbaru',
            'pendingVerifikasi',
            'pembayaranPending',
            'pemasukanHariIni',
            'transaksiHariIni',
            'aktivitas'
        ));
    }
}
