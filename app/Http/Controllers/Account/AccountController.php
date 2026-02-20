<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AccountController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereIn('role', ['owner', 'staf'])->get();
        return view('admin.users', compact('user'));
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

        User::create($validate);

        return redirect()->back()->with('success', 'Account berhasil di Tambahkan');
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'owner') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role === 'staf') {
                return redirect()->route('dashboard.staf');
            }
            return back()->with('error', 'Email atau Password Salah');
        }
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
        //
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
