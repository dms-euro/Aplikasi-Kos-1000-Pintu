@extends('layouts.public')
@section('title', 'Daftar Kamar - Kosan优雅')

@section('content')
<div class="bg-white px-4 py-6 border-b border-gray-200 sticky top-0 z-10">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800">Telusuri Kamar</h1>
        <div class="bg-gray-100 rounded-xl p-2 flex items-center mt-3">
            <i class='bx bx-search text-gray-400 ml-2'></i>
            <input type="text" placeholder="Cari kamar atau lokasi..." class="w-full p-2 bg-transparent focus:outline-none text-sm">
        </div>
    </div>
</div>

<!-- Filter Kategori -->
<div class="container mx-auto px-4 py-4">
    <div class="flex gap-2 overflow-x-auto pb-2">
        <span class="bg-indigo-600 text-white px-4 py-2 rounded-full text-xs whitespace-nowrap">Semua</span>
        <span class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-xs whitespace-nowrap">Standar</span>
        <span class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-xs whitespace-nowrap">Premium</span>
        <span class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-xs whitespace-nowrap">VIP</span>
        <span class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-xs whitespace-nowrap">Deluxe</span>
        <span class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-xs whitespace-nowrap">Ekonomi</span>
    </div>
</div>

<!-- Grid Kamar -->
<div class="container mx-auto px-4 pb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <!-- Item 1 -->
        <a href="/detail-kamar/1" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/4f46e5/white?text=Kos+Melati" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Melati</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Tersedia</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Jakarta Pusat</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp850k</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-wind text-indigo-400'></i></div>
                </div>
            </div>
        </a>
        <!-- Item 2 -->
        <a href="/detail-kamar/2" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/8b5cf6/white?text=Kos+Mawar" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Mawar</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Tersedia</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Bandung</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp1,25jt</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-tv text-indigo-400'></i></div>
                </div>
            </div>
        </a>
        <!-- Item 3 -->
        <a href="/detail-kamar/3" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/d946ef/white?text=Kos+Anggrek" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Anggrek</h3>
                    <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full">Terisi</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Surabaya</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp1,75jt</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-fridge text-indigo-400'></i></div>
                </div>
            </div>
        </a>
        <!-- Item 4 -->
        <a href="/detail-kamar/4" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/10b981/white?text=Kos+Kenanga" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Kenanga</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Tersedia</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Yogyakarta</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp1,5jt</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-bath text-indigo-400'></i></div>
                </div>
            </div>
        </a>
        <!-- Item 5 -->
        <a href="/detail-kamar/5" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/f97316/white?text=Kos+Flamboyan" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Flamboyan</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Tersedia</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Jakarta</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp950k</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-wind text-indigo-400'></i></div>
                </div>
            </div>
        </a>
        <!-- Item 6 -->
        <a href="/detail-kamar/6" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
            <img src="https://placehold.co/400x250/ec4899/white?text=Kos+Bougenville" class="w-full h-40 object-cover">
            <div class="p-4">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-800">Kos Bougenville</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Tersedia</span>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class='bx bx-map'></i> Bandung</p>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-indigo-600 font-bold">Rp1,35jt</span>
                    <div class="flex gap-1"><i class='bx bx-wifi text-indigo-400'></i><i class='bx bx-tv text-indigo-400'></i></div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
