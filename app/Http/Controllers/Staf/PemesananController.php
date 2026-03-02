<?php

namespace App\Http\Controllers\Staf;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController
{
    /**
     * Display a listing of all bookings.
     */
    public function index(Request $request)
    {
        $query = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            if ($request->payment_status == 'sudah') {
                $query->whereHas('pembayaran', function($q) {
                    $q->where('status', 'paid');
                });
            } elseif ($request->payment_status == 'belum') {
                $query->whereDoesntHave('pembayaran', function($q) {
                    $q->where('status', 'paid');
                });
            } elseif ($request->payment_status == 'menunggu') {
                $query->whereHas('pembayaran', function($q) {
                    $q->where('status', 'pending');
                });
            }
        }

        // Search by penghuni name or kamar code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('penghuni', function($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%");
                })->orWhereHas('kamar', function($sub) use ($search) {
                    $sub->where('kode_kamar', 'like', "%{$search}%");
                });
            });
        }

        $pemesanan = $query->paginate(15)->withQueryString();

        // For statistics
        $totalPending = Pemesanan::where('status', 'pending')->count();
        $totalConfirmed = Pemesanan::where('status', 'confirmed')->count();
        $totalCancelled = Pemesanan::where('status', 'cancelled')->count();
        $pendingPayments = Pembayaran::where('status', 'pending')->count();

        return view('staf.pemesanan', compact(
            'pemesanan',
            'totalPending',
            'totalConfirmed',
            'totalCancelled',
            'pendingPayments'
        ));
    }

    /**
     * Display bookings with pending payments.
     */
    public function pendingPayments()
    {
        $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran' => function($q) {
                $q->where('status', 'pending');
            }])
            ->whereHas('pembayaran', function($q) {
                $q->where('status', 'pending');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staf.pemesanan-pending', compact('pemesanan'));
    }

    /**
     * Show the form for creating a new payment (for cash payment).
     */
    public function createPayment($id)
    {
        $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar'])->findOrFail($id);

        if ($pemesanan->pembayaran()->where('status', 'paid')->exists()) {
            return redirect()->route('staf.pemesanan.index')
                ->with('error', 'Pemesanan ini sudah memiliki pembayaran lunas.');
        }

        return view('staf.payment-create', compact('pemesanan'));
    }

    /**
     * Store a new payment (for cash payment).
     */
    public function storePayment(Request $request, $id)
    {
        $request->validate([
            'tanggal_bayar' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'tanggal_bayar' => $request->tanggal_bayar,
            'jumlah' => $request->jumlah,
            'status' => 'paid',
            'petugas_id' => Auth::id(),
            'bukti_bayar' => null,
        ]);

        $pemesanan->update(['status' => 'confirmed']);

        $pemesanan->kamar->update(['status' => 'terisi']);

        return redirect()->route('staf.pemesanan.index')
            ->with('success', 'Pembayaran tunai berhasil dicatat dan pemesanan dikonfirmasi.');
    }

    /**
     * Approve a payment (for transfer payments).
     */
    public function approvePayment($id)
    {
        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);

        if ($pembayaran->status !== 'pending') {
            return redirect()->back()->with('error', 'Pembayaran sudah diproses.');
        }

        // Update payment status
        $pembayaran->update([
            'status' => 'paid',
            'petugas_id' => Auth::id(),
        ]);

        // Update pemesanan status
        $pembayaran->pemesanan->update(['status' => 'confirmed']);

        // Update kamar status
        $pembayaran->pemesanan->kamar->update(['status' => 'terisi']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Reject a payment.
     */
    public function rejectPayment(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);

        if ($pembayaran->status !== 'pending') {
            return redirect()->back()->with('error', 'Pembayaran sudah diproses.');
        }

        // Update payment status
        $pembayaran->update([
            'status' => 'failed',
            'petugas_id' => Auth::id(),
        ]);

        // Optional: Add reason to notes or create a rejection log
        // You might want to add a notes field to pembayaran table

        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }

    /**
     * Cancel a booking.
     */
    public function cancelBooking(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $pemesanan = Pemesanan::with('kamar')->findOrFail($id);

        if ($pemesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan tidak dapat dibatalkan.');
        }

        // Update pemesanan status
        $pemesanan->update(['status' => 'cancelled']);

        // Update kamar status back to tersedia
        $pemesanan->kamar->update(['status' => 'tersedia']);

        // If there's a pending payment, mark it as failed
        $pemesanan->pembayaran()->where('status', 'pending')->update(['status' => 'failed']);

        return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    /**
     * Show details of a specific booking.
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['penghuni', 'kamar.tipe_kamar', 'pembayaran.petugas'])
            ->findOrFail($id);

        return view('staf.pemesanan-show', compact('pemesanan'));
    }
}
