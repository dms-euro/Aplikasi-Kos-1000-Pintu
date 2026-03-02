<?php

namespace App\Http\Controllers\Staf;

use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController
{
    /**
     * Menampilkan daftar penghuni yang sudah memesan kamar
     */
    public function index(Request $request)
    {
        // Ambil semua penghuni yang memiliki pemesanan (sudah memesan kamar)
        $query = Penghuni::whereHas('pemesanan', function ($q) {
            $q->whereIn('status', ['pending', 'confirmed']);
        })
            ->with(['pemesanan' => function ($q) {
                $q->with('kamar.tipe_kamar')
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->latest();
            }]);

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kontak', 'like', "%{$search}%");
            });
        }

        // Filter status pemesanan
        if ($request->filled('status')) {
            $query->whereHas('pemesanan', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $penghuni = $query->paginate(15)->withQueryString();

        // Statistik
        $totalAktif = Penghuni::whereHas('pemesanan', function ($q) {
            $q->where('status', 'confirmed');
        })->count();

        $totalPending = Penghuni::whereHas('pemesanan', function ($q) {
            $q->where('status', 'pending');
        })->count();

        return view('staf.penghuni', compact('penghuni', 'totalAktif', 'totalPending'));
    }

    /**
     * Menampilkan detail penghuni dan riwayat pemesanannya
     */
    public function show($id)
    {
        $penghuni = Penghuni::with(['pemesanan' => function ($q) {
            $q->with('kamar.tipe_kamar')
                ->orderBy('created_at', 'desc');
        }])
            ->findOrFail($id);

        return view('staf.penghuni-show', compact('penghuni'));
    }
}
