@extends('layouts.app')

@section('title', 'Management Account | Bapak Kos')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2"><i
                    class='bx bx-group text-indigo-500'></i> Daftar Pengguna</h2>
            <button id="createUserBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 transition shadow-sm"
                data-modal-target="userModal" data-modal-toggle="userModal" onclick="openCreateModal()">
                <i class='bx bx-plus-circle'></i> Tambah User
            </button>
        </div>

        <!-- Tabel User -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-50 to-indigo-100/50 border-b border-indigo-200">
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                Nama</th>
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                Created At</th>
                            <th
                                class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($user as $item)
                            <tr class="hover:bg-indigo-50/50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->nama }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->role == 'owner')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                            Owner
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                            {{ ucfirst($item->role) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-sm">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('account.delete', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 hover:border-red-300 transition-all duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="text-gray-500 text-sm">Tidak ada data user</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer dengan total pengguna -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <div class="flex items-center justify-between text-xs text-gray-600">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>{{ $user->count() }} pengguna terdaftar</span>
                    </div>
                    <span class="text-gray-400">Last updated: {{ now()->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FLOWBITE (untuk create & edit) - hidden by default -->
    <div id="userModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-100">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-indigo-100 rounded-t-2xl">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2" id="modalTitle">
                        <i class='bx bx-user-plus text-indigo-600'></i> Tambah User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-indigo-100 hover:text-indigo-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="userModal">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>
                <!-- Modal body form -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('account.store') }}" method="POST" id="userForm" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-user text-indigo-400'></i> Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="Masukkan nama" required>
                        </div>

                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-envelope text-indigo-400'></i> Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="nama@email.com" required>
                        </div>

                        <div id="passwordFieldContainer">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-lock-alt text-indigo-400'></i> Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="••••••••" required>
                        </div>

                        <div>
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-badge-check text-indigo-400'></i> Role</label>
                            <select id="role" name="role"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih role</option>
                                <option value="owner">Owner</option>
                                <option value="staf">Staf</option>
                                <option value="penghuni">Penghuni</option>
                            </select>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Simpan</button>
                            <button type="button" data-modal-hide="userModal"
                                class="w-full text-indigo-600 bg-white border border-indigo-200 hover:bg-indigo-50 focus:ring-4 focus:outline-none focus:ring-indigo-100 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
