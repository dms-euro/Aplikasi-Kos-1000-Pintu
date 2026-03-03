@extends('layouts.public')
@section('title', 'Edit Profile - BapakKos')

@section('content')
<div class="relative bg-gradient-to-r from-indigo-600 to-indigo-500 text-white overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    </div>

    <div class="container mx-auto px-4 py-10 relative">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Edit Profile</h1>
                <p class="text-indigo-100 text-sm mt-1">Perbarui informasi data diri Anda</p>
            </div>
        </div>
    </div>

    <!-- Simple Wave -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 40L60 35C120 30 240 20 360 15C480 10 600 10 720 12.5C840 15 960 20 1080 22.5C1200 25 1320 25 1380 25L1440 25V40H1380C1320 40 1200 40 1080 40C960 40 840 40 720 40C600 40 480 40 360 40C240 40 120 40 60 40H0Z"
                    fill="white" fill-opacity="0.1"/>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8 max-w-3xl">
    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-start gap-3">
        <i class='bx bx-error-circle text-xl flex-shrink-0 mt-0.5'></i>
        <div>
            <p class="font-medium">Terdapat kesalahan:</p>
            <ul class="list-disc list-inside text-sm mt-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Card Header with Tabs Style -->
        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="w-1 h-6 bg-indigo-600 rounded-full"></div>
                <h2 class="font-semibold text-gray-800">Form Edit Profile</h2>
            </div>
            <p class="text-xs text-gray-500 mt-1 ml-3">Lengkapi data diri Anda dengan benar</p>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <!-- Informasi Akun -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <i class='bx bx-user text-indigo-600'></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Informasi Akun</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-user-circle text-gray-400'></i>
                                </div>
                                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                                       class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-envelope text-gray-400'></i>
                                </div>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                       class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                       placeholder="contoh@email.com"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <i class='bx bx-detail text-indigo-600'></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Data Pribadi</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-user text-gray-400'></i>
                                </div>
                                <select name="kelamin" class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm appearance-none bg-white" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('kelamin', $penghuni->kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('kelamin', $penghuni->kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400'></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-calendar text-gray-400'></i>
                                </div>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penghuni->tanggal_lahir ?? '') }}"
                                       class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                       required>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Pekerjaan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-briefcase text-gray-400'></i>
                                </div>
                                <select name="pekerjaan" class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm appearance-none bg-white" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="Karyawan" {{ old('pekerjaan', $penghuni->pekerjaan ?? '') == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                                    <option value="Mahasiswa" {{ old('pekerjaan', $penghuni->pekerjaan ?? '') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="Lainnya" {{ old('pekerjaan', $penghuni->pekerjaan ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400'></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Kontak <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-phone text-gray-400'></i>
                                </div>
                                <input type="text" name="kontak" value="{{ old('kontak', $penghuni->kontak ?? '') }}"
                                       class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                       placeholder="08123456789"
                                       required>
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Kontak Darurat <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-error-circle text-gray-400'></i>
                                </div>
                                <input type="text" name="kontak_darurat" value="{{ old('kontak_darurat', $penghuni->kontak_darurat ?? '') }}"
                                       class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                       placeholder="Nomor yang bisa dihubungi dalam keadaan darurat"
                                       required>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Nomor keluarga atau kerabat terdekat</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                        <i class='bx bx-save'></i>
                        Simpan Perubahan
                    </button>
                    <button type="reset"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition text-sm font-medium flex items-center justify-center gap-2">
                        <i class='bx bx-x'></i>
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Change Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="w-1 h-6 bg-amber-500 rounded-full"></div>
                <h2 class="font-semibold text-gray-800">Keamanan Akun</h2>
            </div>
            <p class="text-xs text-gray-500 mt-1 ml-3">Ganti password secara berkala untuk keamanan</p>
        </div>

        <div class="p-6">
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">
                            Password Saat Ini
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class='bx bx-lock-alt text-gray-400'></i>
                            </div>
                            <input type="password" name="current_password"
                                    class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                    placeholder="Masukkan password saat ini"
                                    required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Password Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-lock text-gray-400'></i>
                                </div>
                                <input type="password" name="new_password"
                                        class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                        placeholder="Minimal 8 karakter"
                                        required>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class='bx bx-lock-open text-gray-400'></i>
                                </div>
                                <input type="password" name="new_password_confirmation"
                                        class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                        placeholder="Ketik ulang password baru"
                                        required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="mt-4 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                    <i class='bx bx-lock-alt'></i>
                    Update Password
                </button>
            </form>
        </div>
    </div>

    <!-- Info Tambahan -->
    <div class="bg-blue-50 rounded-lg p-4 mt-6 flex items-start gap-3">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
            <i class='bx bx-info-circle text-blue-600'></i>
        </div>
        <div class="text-sm text-blue-800">
            <p class="font-medium mb-1">Informasi Penting:</p>
            <p class="text-xs text-blue-600">Data yang Anda masukkan akan digunakan untuk keperluan administrasi dan kontak darurat. Pastikan data yang diisi sudah benar.</p>
        </div>
    </div>
</div>
@endsection
