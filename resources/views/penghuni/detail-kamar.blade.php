@extends('layouts.public')
@section('title', 'Detail Kamar - Kosan优雅')

@section('content')
    <div class="relative">
        <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" class="w-full h-64 md:h-96 object-cover">

        <a href="{{ url('/') }}"
            class="absolute top-4 left-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
            <i class='bx bx-arrow-back text-xl'></i>
        </a>

        <button class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
            <i class='bx bx-heart text-xl'></i>
        </button>
    </div>

    <div class="container mx-auto px-4 py-6 max-w-4xl">

        <!-- Judul & Harga -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    {{ $kamar->tipe_kamar->tipe }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Kode Kamar: {{ $kamar->kode_kamar }}
                </p>
            </div>

            <div class="bg-indigo-50 px-4 py-2 rounded-full self-start">
                <span class="text-indigo-600 font-bold text-xl">
                    Rp{{ number_format($kamar->tipe_kamar->harga) }}
                </span>
            </div>
        </div>

        <!-- Status -->
        <div class="mt-4">
            @if ($kamar->status == 'tersedia')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    Tersedia
                </span>
            @else
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm">
                    Terisi
                </span>
            @endif
        </div>

        <!-- Fasilitas -->
        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-3">Fasilitas</h3>

            <div class="grid grid-cols-4 md:grid-cols-6 gap-4 text-center text-xs">

                @if ($kamar->tipe_kamar->kasur)
                    <div>
                        <i class='bx bx-bed text-2xl text-indigo-600'></i>
                        <p class="mt-1">Kasur</p>
                    </div>
                @endif

                @if ($kamar->tipe_kamar->lemari)
                    <div>
                        <i class='bx bx-closet text-2xl text-indigo-600'></i>
                        <p class="mt-1">Lemari</p>
                    </div>
                @endif

                @if ($kamar->tipe_kamar->ac)
                    <div>
                        <i class='bx bx-wind text-2xl text-indigo-600'></i>
                        <p class="mt-1">AC</p>
                    </div>
                @endif

                @if ($kamar->tipe_kamar->wifi)
                    <div>
                        <i class='bx bx-wifi text-2xl text-indigo-600'></i>
                        <p class="mt-1">WiFi</p>
                    </div>
                @endif

                @if ($kamar->tipe_kamar->kamar_mandi)
                    <div>
                        <i class='bx bx-bath text-2xl text-indigo-600'></i>
                        <p class="mt-1">Kamar Mandi</p>
                    </div>
                @endif

                @if ($kamar->tipe_kamar->tv)
                    <div>
                        <i class='bx bx-tv text-2xl text-indigo-600'></i>
                        <p class="mt-1">TV</p>
                    </div>
                @endif

            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                {{ $kamar->tipe_kamar->deskripsi ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

        <!-- Tombol Sewa -->
        <div class="mt-8 mb-6">
            @if ($kamar->status == 'tersedia')
                @auth
                    @if (auth()->user()->role == 'penghuni')
                        <button onclick="openModal()"
                            class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition text-lg text-center">
                            Sewa Sekarang
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition text-lg text-center">
                        Login untuk Sewa
                    </a>
                @endauth
            @else
                <button disabled
                    class="block w-full bg-gray-400 text-white py-4 rounded-xl font-semibold text-lg text-center cursor-not-allowed">
                    Sudah Terisi
                </button>
            @endif
        </div>

    </div>

    <!-- Modal Sewa -->
    <div id="sewaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-6 w-full max-w-md relative">

            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 text-xl">
                ✕
            </button>

            <h2 class="text-xl font-bold mb-4">
                Konfirmasi Sewa
            </h2>

            <form action="{{ route('sewa.store', $kamar->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm mb-1">
                        Tanggal Masuk
                    </label>
                    <input type="date" name="tanggal_masuk" class="w-full border rounded-lg p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1">
                        Durasi (bulan)
                    </label>
                    <input type="number" name="durasi_bulanan" min="1" value="1"
                        class="w-full border rounded-lg p-2" required>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold">
                    Konfirmasi Sewa
                </button>
            </form>

        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function openModal() {
            document.getElementById('sewaModal').classList.remove('hidden');
            document.getElementById('sewaModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('sewaModal').classList.add('hidden');
        }
    </script>
@endpush
