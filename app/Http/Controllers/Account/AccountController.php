<?php

namespace App\Http\Controllers\Account;

use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController
{
    // Auth
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'owner') {
                return redirect()->route('admin.dashboard.admin');
            }

            if ($user->role === 'staf') {
                return redirect()->route('staf.dashboard.staf');
            }

            if ($user->role === 'penghuni') {
                return redirect()->route('dashboard.penghuni');
            }
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereIn('role', ['owner', 'staf'])->get();
        return view('admin.users', compact('user'));
    }

    public function penghuni()
    {
        $penghuni = Penghuni::with('user')->get();
        $user = User::where('role', 'penghuni')->get();
        return view('admin.penghuni', compact('penghuni', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);

        return redirect()->back()->with('success', 'Account berhasil di Tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',

            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|in:Karyawan,Mahasiswa,Lainnya',
            'kontak' => 'required|string|max:15',
            'kontak_darurat' => 'required|string|max:15',
        ]);
        $user = User::findOrFail($id);
        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        $penghuni = Penghuni::where('users_id', $id)->firstOrFail();
        $penghuni->update([
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'kontak' => $request->kontak,
            'kontak_darurat' => $request->kontak_darurat,
        ]);

        return redirect()->back()->with('success', 'Data penghuni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $account = User::findOrFail($id);
            $account->delete();

            return back()->with('success', 'Account Berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
