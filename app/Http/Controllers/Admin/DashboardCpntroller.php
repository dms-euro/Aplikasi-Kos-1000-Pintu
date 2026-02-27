<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Penghuni;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardCpntroller
{
    public function index()
    {
        // Statistik Utama
        $totalPenghuni = Penghuni::count();
        $penghuniBaru = Penghuni::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

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
        $pemesananAktif = Pemesanan::where('status', 'confirmed')->count();
        $pemesananPending = Pemesanan::where('status', 'pending')->count();

        // Pemesanan terbaru (5 data)
        $pemesananTerbaru = Pemesanan::with(['penghuni', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pemasukan
        $pemasukanBulanIni = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah');

        $totalTransaksi = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->count();

        // Grafik pemasukan 7 hari terakhir
        $grafikLabel = [];
        $grafikData = [];
        $totalPemasukan7Hari = 0;

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $nominal = Pembayaran::whereDate('tanggal_bayar', $date->format('Y-m-d'))
                ->sum('jumlah');

            $grafikLabel[] = $date->format('d/m');
            $grafikData[] = $nominal;
            $totalPemasukan7Hari += $nominal;
        }

        // 5 pemasukan terbesar bulan ini
        $pemasukanTerbesar = Pembayaran::with(['pemesanan.penghuni', 'pemesanan.kamar'])
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        // Aktivitas terkini (kombinasi dari berbagai model)
        $aktivitas = collect();

        // Tambahkan pemesanan baru
        $pemesananBaru = Pemesanan::with('penghuni')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Pemesanan baru dari ' . ($item->penghuni->nama ?? 'penghuni'),
                    'waktu' => $item->created_at->diffForHumans(),
                    'status' => 'pemesanan'
                ];
            });

        // Tambahkan pembayaran baru
        $pembayaranBaru = Pembayaran::with('pemesanan.penghuni')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Pembayaran ' . ($item->pemesanan->penghuni->nama ?? 'penghuni') . ' sebesar Rp ' . number_format($item->jumlah, 0, ',', '.'),
                    'waktu' => $item->created_at->diffForHumans(),
                    'status' => 'pembayaran'
                ];
            });

        // Tambahkan penghuni baru
        $penghuniBaruData = Penghuni::orderBy('created_at', 'desc')
            ->limit(2)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'deskripsi' => 'Penghuni baru: ' . $item->nama,
                    'waktu' => $item->created_at->diffForHumans(),
                    'status' => 'penghuni'
                ];
            });

        $aktivitas = $pemesananBaru->concat($pembayaranBaru)->concat($penghuniBaruData)
            ->sortByDesc(function ($item) {
                // Sorting manual karena diffForHumans tidak bisa diurutkan langsung
                return strtotime(str_replace(['detik', 'menit', 'jam', 'hari', 'bulan', 'tahun'], ['second', 'minute', 'hour', 'day', 'month', 'year'], $item->waktu));
            })
            ->take(5)
            ->values();

        return view('admin.dashboard', compact(
            'totalPenghuni',
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
            'pemesananAktif',
            'pemesananPending',
            'pemesananTerbaru',
            'pemasukanBulanIni',
            'totalTransaksi',
            'grafikLabel',
            'grafikData',
            'totalPemasukan7Hari',
            'pemasukanTerbesar',
            'aktivitas'
        ));
    }
}
