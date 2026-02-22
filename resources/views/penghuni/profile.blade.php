@extends('layouts.public')
@section('title', 'Profile - Kosan优雅')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 pt-8 pb-12">
    <div class="container mx-auto">
        <div class="flex flex-col sm:flex-row items-center gap-6 text-white">
            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center">
                <i class='bx bx-user-circle text-5xl text-indigo-600'></i>
            </div>
            <div class="text-center sm:text-left">
                <h2 class="text-2xl font-bold">Ahmad Fauzi</h2>
                <p class="text-indigo-100">ahmad.fauzi@email.com</p>
                <p class="text-indigo-200 text-sm mt-1">Member sejak Desember 2025</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 -mt-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow-md p-5">
        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 pb-3">
            <span class="text-gray-600">Nomor HP</span>
            <span class="font-medium">0812-3456-7890</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-100 py-3">
            <span class="text-gray-600">Kamar aktif</span>
            <span class="font-medium text-indigo-600">Kos Melati (A-101)</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between pt-3">
            <span class="text-gray-600">Status</span>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs self-start sm:self-center">Aktif</span>
        </div>
    </div>

    <div class="mt-6 space-y-2">
        <a href="#" class="block bg-white rounded-xl p-4 flex items-center gap-3 shadow-sm hover:bg-gray-50 transition">
            <i class='bx bx-history text-2xl text-indigo-600'></i>
            <span class="flex-1 text-gray-800">Riwayat Sewa</span>
            <i class='bx bx-chevron-right text-gray-400'></i>
        </a>
        <a href="#" class="block bg-white rounded-xl p-4 flex items-center gap-3 shadow-sm hover:bg-gray-50 transition">
            <i class='bx bx-lock-alt text-2xl text-indigo-600'></i>
            <span class="flex-1 text-gray-800">Ubah Password</span>
            <i class='bx bx-chevron-right text-gray-400'></i>
        </a>
        <a href="#" class="block bg-white rounded-xl p-4 flex items-center gap-3 shadow-sm hover:bg-gray-50 transition">
            <i class='bx bx-log-out text-2xl text-rose-500'></i>
            <span class="flex-1 text-gray-800">Keluar</span>
            <i class='bx bx-chevron-right text-gray-400'></i>
        </a>
    </div>
</div>
@endsection
