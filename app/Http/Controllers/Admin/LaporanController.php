<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Routing\Controller as RoutingController;

class LaporanController extends RoutingController
{
    /**
     * Menampilkan halaman laporan kamar dan keuangan
     */
    public function index(Request $request)
    {
        $bulan = (int) $request->bulan ?: now()->month;
        $tahun = (int) $request->tahun ?: now()->year;

        // Data untuk laporan kamar yang digunakan (status pemesanan 'confirmed' dan masih dalam masa sewa)
        $kamarDigunakan = Pemesanan::with(['kamar.tipe_kamar', 'penghuni'])
            ->where('status', 'confirmed')
            ->where('tanggal_masuk', '<=', now())
            ->where('tanggal_keluar', '>=', now())
            ->get();

        // Data pemasukan dari tabel pembayaran (semua pembayaran adalah pemasukan)
        $pemasukan = Pembayaran::with(['pemesanan.penghuni', 'pemesanan.kamar'])
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->get();

        // Total pemasukan bulan ini
        $totalPemasukan = $pemasukan->sum('jumlah');

        // Grafik pemasukan per bulan (untuk 6 bulan terakhir)
        $grafikBulan = [];
        $grafikNominal = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulanTeks = $date->format('M Y');
            $nominal = Pembayaran::whereMonth('tanggal_bayar', $date->month)
                ->whereYear('tanggal_bayar', $date->year)
                ->sum('jumlah');

            $grafikBulan[] = $bulanTeks;
            $grafikNominal[] = $nominal;
        }

        // Statistik kamar
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarDipesan = Kamar::where('status', 'dipesan')->count();
        $kamarPerbaikan = Kamar::where('status', 'perbaikan')->count();

        // 5 penyewa dengan pembayaran tertinggi bulan ini (berdasarkan pembayaran)
        $penyewaTop = Pembayaran::with('pemesanan.penghuni')
            ->select('pemesanan_id', DB::raw('SUM(jumlah) as total_bayar'))
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->groupBy('pemesanan_id')
            ->orderBy('total_bayar', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'penghuni' => $item->pemesanan->penghuni ?? null,
                    'total_bayar' => $item->total_bayar
                ];
            });

        return view('admin.laporan', compact(
            'kamarDigunakan',
            'pemasukan',
            'totalPemasukan',
            'bulan',
            'tahun',
            'grafikBulan',
            'grafikNominal',
            'totalKamar',
            'kamarTerisi',
            'kamarTersedia',
            'kamarDipesan',
            'kamarPerbaikan',
            'penyewaTop'
        ));
    }
}
