@extends('layouts.public')
@section('title', 'Kamar Saya - Kosan优雅')

@section('content')
<div class="bg-white px-4 py-6 border-b border-gray-200">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800">Kamar Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Kamar yang sedang kamu huni</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 max-w-3xl">
    <!-- Active Room Card -->
    <div class="bg-white rounded-2xl border border-indigo-100 p-4 shadow-sm mb-4">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
            <div>
                <h3 class="font-semibold text-gray-800 text-lg">Kos Melati</h3>
                <p class="text-sm text-gray-500 mt-1">Kamar: A-101 · Jakarta Pusat</p>
            </div>
            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs self-start">Aktif</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <div>
                <p class="text-xs text-gray-500">Masa berlaku</p>
                <p class="text-sm font-medium">10 Mar 2026 - 10 Jun 2026</p>
            </div>
            <div class="sm:text-right">
                <p class="text-xs text-gray-500">Tagihan bulan ini</p>
                <p class="text-lg font-bold text-indigo-600">Rp850.000</p>
            </div>
        </div>
        <a href="#" class="block w-full mt-4 bg-indigo-50 text-indigo-700 py-3 rounded-xl text-sm font-medium text-center hover:bg-indigo-100 transition">
            <i class='bx bx-receipt'></i> Lihat Invoice
        </a>
    </div>

    <!-- History Card -->
    <div class="bg-white rounded-2xl border border-indigo-100 p-4 shadow-sm opacity-75">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
            <div>
                <h3 class="font-semibold text-gray-800">Kos Mawar</h3>
                <p class="text-sm text-gray-500 mt-1">Kamar: B-02 · Bandung</p>
            </div>
            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs self-start">Selesai</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <div>
                <p class="text-xs text-gray-500">Masa berlaku</p>
                <p class="text-sm">10 Des 2025 - 10 Mar 2026</p>
            </div>
            <div class="sm:text-right">
                <p class="text-xs text-gray-500">Total dibayar</p>
                <p class="text-lg font-medium">Rp3.750.000</p>
            </div>
        </div>
        <a href="#" class="block w-full mt-4 bg-gray-100 text-gray-600 py-3 rounded-xl text-sm font-medium text-center">
            <i class='bx bx-receipt'></i> Arsip
        </a>
    </div>
</div>
@endsection
