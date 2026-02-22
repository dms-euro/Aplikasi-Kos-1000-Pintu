@extends('layouts.public')
@section('title', 'Chat & Notifikasi - Kosan优雅')

@section('content')
<div class="bg-white px-4 py-6 border-b border-gray-200">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800">Pesan & Notifikasi</h1>
    </div>
</div>

<!-- Tabs -->
<div class="container mx-auto px-4">
    <div class="flex border-b border-gray-200">
        <a href="#" class="flex-1 py-3 text-sm font-medium text-indigo-600 border-b-2 border-indigo-600 text-center">Chat</a>
        <a href="#" class="flex-1 py-3 text-sm font-medium text-gray-500 text-center">Notifikasi</a>
    </div>
</div>

<!-- Konten Chat -->
<div class="container mx-auto px-4 py-4 max-w-3xl">
    <div class="space-y-4">
        <!-- Pesan terkirim -->
        <div class="flex justify-end">
            <div class="bg-indigo-600 text-white rounded-t-2xl rounded-bl-2xl p-3 max-w-[75%]">
                <p class="text-sm">Selamat pagi, saya ingin mengajukan komplain AC di kamar saya tidak dingin. Mohon segera diperbaiki.</p>
            </div>
        </div>
        <div class="text-right text-xs text-gray-400">10:30, 22 Feb 2026</div>

        <!-- Balasan admin -->
        <div class="flex justify-start">
            <div class="bg-gray-100 text-gray-800 rounded-t-2xl rounded-br-2xl p-3 max-w-[75%]">
                <p class="text-sm">Baik pak, akan segera kami kirim teknisi ke kamar Bpk hari ini. Mohon tunggu.</p>
            </div>
        </div>
        <div class="text-left text-xs text-gray-400">10:35, 22 Feb 2026 · Admin</div>

        <!-- Notifikasi sistem -->
        <div class="flex justify-start">
            <div class="bg-blue-50 text-gray-800 rounded-t-2xl rounded-br-2xl p-3 max-w-[75%]">
                <p class="text-sm"><i class='bx bx-check-circle text-blue-500 mr-1'></i>Pembayaran Anda telah diterima. Invoice bulan Maret 2026 tersedia.</p>
            </div>
        </div>
        <div class="text-left text-xs text-gray-400">Sistem · 21 Feb 2026</div>
    </div>
</div>

<!-- Kotak tulis komplain -->
<div class="bg-white border-t border-gray-200 p-3 mt-4">
    <div class="container mx-auto max-w-3xl">
        <div class="flex gap-2">
            <input type="text" placeholder="Tulis komplain atau pesan..." class="flex-1 bg-gray-100 rounded-full px-4 py-3 text-sm focus:outline-none">
            <button class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-700 transition">
                <i class='bx bx-send'></i>
            </button>
        </div>
    </div>
</div>
@endsection
