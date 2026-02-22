@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6 text-center">Register Penghuni</h2>

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <input type="text" name="nama" placeholder="Nama Lengkap"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="password" name="password_confirmation"
            placeholder="Konfirmasi Password"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <!-- Kelamin -->
        <select name="kelamin"
            class="w-full mb-3 border p-3 rounded-lg" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <input type="date" name="tanggal_lahir"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="text" name="pekerjaan" placeholder="Pekerjaan"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="text" name="kontak" placeholder="No HP"
            class="w-full mb-3 border p-3 rounded-lg" required>

        <input type="text" name="kontak_darurat" placeholder="Kontak Darurat"
            class="w-full mb-5 border p-3 rounded-lg" required>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-sm text-center mt-4">
        Sudah punya akun?
        <a href="/login" class="text-indigo-600 font-semibold">
            Login
        </a>
    </p>

</div>
@endsection
