<?php

namespace App\Http\Controllers\Account;

use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenghuniAuthController
{

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'kontak_darurat' => 'required|string|max:20',
        ]);

        // Buat User
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penghuni',
        ]);

        // Buat Penghuni
        Penghuni::create([
            'users_id' => $user->id,
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'kontak' => $request->kontak,
            'kontak_darurat' => $request->kontak_darurat,
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    public function me()
    {
        $user = Auth::user();

        $penghuni = Penghuni::where('users_id', $user->id)->first();

        $pemesananAktif = $penghuni ? $penghuni->pemesanan()
            ->whereIn('status', ['pending', 'dikonfirmasi', 'aktif'])
            ->with('kamar.tipe_kamar')
            ->latest()
            ->first() : null;

        $riwayatPemesanan = $penghuni ? $penghuni->pemesanan()
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->with('kamar.tipe_kamar')
            ->latest()
            ->take(3)
            ->get() : collect();

        $jumlahKomplain = $penghuni ? $penghuni->komplain()->count() : 0;

        return view('penghuni.me', compact('user', 'penghuni', 'pemesananAktif', 'riwayatPemesanan', 'jumlahKomplain'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
