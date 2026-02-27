@extends('layouts.app')
@section('title', 'Manajemen Penghuni | Bapak Kos')
@section('content')

<div class="p-6">
    <!-- Header dengan Judul dan Tombol Tambah -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class='bx bx-group text-indigo-600'></i>
                Manajemen Penghuni
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data penghuni kos</p>
        </div>
    </div>

    <!-- Statistik Singkat -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-group text-xl text-indigo-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Penghuni</p>
                    <p class="text-xl font-bold text-gray-800">{{ $penghuni->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-male text-xl text-green-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Laki-laki</p>
                    <p class="text-xl font-bold text-gray-800">{{ $penghuni->where('kelamin', 'Laki-laki')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-female text-xl text-pink-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Perempuan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $penghuni->where('kelamin', 'Perempuan')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-calendar-check text-xl text-amber-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Bergabung Bulan Ini</p>
                    <p class="text-xl font-bold text-gray-800">{{ $penghuni->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Penghuni -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-indigo-50/50 border-b border-indigo-200">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Kelamin</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Pekerjaan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Tgl Lahir</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($penghuni as $index => $item)
                        <tr class="hover:bg-indigo-50/50 transition-colors duration-150 ease-in-out">
                            <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-sm font-bold">
                                        {{ substr($item->nama, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->user->email ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($item->kelamin == 'Laki-laki')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                        Laki-laki
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-700 border border-pink-200">
                                        <span class="w-1.5 h-1.5 bg-pink-500 rounded-full mr-1.5"></span>
                                        Perempuan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->kontak ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $item->pekerjaan ?? 'Lainnya' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <!-- Tombol Show -->
                                    <button type="button" onclick="showDetail({{ $item->id }})"
                                        class="inline-flex items-center p-2 text-xs font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-all"
                                        title="Lihat Detail">
                                        <i class='bx bx-show text-lg text-indigo-600'></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <button type="button" onclick="openEditModal({{ $item->id }})"
                                        class="inline-flex items-center p-2 text-xs font-medium text-amber-600 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 hover:text-amber-700 transition-all"
                                        title="Edit Penghuni">
                                        <i class='bx bx-edit-alt text-lg text-amber-600'></i>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.account.delete', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center p-2 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all"
                                            title="Hapus Penghuni">
                                            <i class='bx bx-trash text-lg'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-gray-500 text-sm">Tidak ada data penghuni</p>
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
                    <span>{{ $penghuni->count() }} penghuni terdaftar</span>
                </div>
                <span class="text-gray-400">Last updated: {{ now()->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL PENGHUNI -->
<div id="detailModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-xl border border-indigo-100">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b border-indigo-100 rounded-t-2xl bg-purple-50">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-user-detail text-indigo-600'></i>
                    Detail Penghuni
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-indigo-100 hover:text-indigo-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    onclick="closeDetailModal()">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6" id="detailContent">
                <!-- Content will be filled by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PENGHUNI (Menggantikan Modal Tambah) -->
<div id="editModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-xl border border-indigo-100">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b border-indigo-100 rounded-t-2xl bg-purple-50">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2" id="modalTitle">
                    <i class='bx bx-edit text-indigo-600'></i>
                    Edit Penghuni
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-indigo-100 hover:text-indigo-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    onclick="closeEditModal()">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>
            <!-- Modal body form -->
            <div class="p-6">
                <form id="editForm" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editUserId" name="userId">

                    <!-- Data User (Akun) -->
                    <div class="border-b border-gray-200 pb-4">
                        <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class='bx bx-lock text-indigo-500'></i>
                            Data Akun
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" id="edit_nama"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="Masukkan nama" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="edit_email"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="nama@email.com" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Password <span class="text-xs text-gray-500 font-normal">(Kosongkan jika tidak ingin mengubah)</span></label>
                                <input type="password" name="password" id="edit_password"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <!-- Data Penghuni -->
                    <div>
                        <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class='bx bx-user text-indigo-500'></i>
                            Data Penghuni
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="penghuni_nama" id="edit_penghuni_nama"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="Nama lengkap" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="kelamin" id="edit_kelamin"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled>Pilih kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Pekerjaan</label>
                                <select name="pekerjaan" id="edit_pekerjaan"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled>Pilih pekerjaan</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">No. Kontak</label>
                                <input type="text" name="kontak" id="edit_kontak"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="081234567890" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Kontak Darurat</label>
                                <input type="text" name="kontak_darurat" id="edit_kontak_darurat"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="081234567890" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-medium transition shadow-md">
                            Update Data
                        </button>
                        <button type="button" onclick="closeEditModal()"
                            class="flex-1 border border-gray-300 hover:bg-gray-50 py-3 rounded-xl font-medium transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Data penghuni dari server (untuk keperluan modal detail & edit)
    const penghuniData = @json($penghuni);
    const userData = @json($user);

    // Fungsi untuk menampilkan modal detail
    function showDetail(id) {
        const penghuni = penghuniData.find(p => p.id === id);
        if (!penghuni) return;

        const user = userData.find(u => u.id === penghuni.users_id);

        const detailHtml = `
            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-indigo-100">
                <div class="w-16 h-16 rounded-full bg-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                    ${penghuni.nama.charAt(0).toUpperCase()}
                </div>
                <div>
                    <h4 class="text-xl font-bold text-gray-800">${penghuni.nama}</h4>
                    <p class="text-sm text-gray-500">${user?.email || '-'}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="bg-indigo-50/50 p-4 rounded-xl">
                    <p class="text-xs text-indigo-600 font-medium mb-1">Jenis Kelamin</p>
                    <p class="text-gray-800 font-medium flex items-center gap-1">
                        <i class='bx ${penghuni.kelamin === 'Laki-laki' ? 'bx-male' : 'bx-female'} text-indigo-500'></i>
                        ${penghuni.kelamin}
                    </p>
                </div>
                <div class="bg-indigo-50/50 p-4 rounded-xl">
                    <p class="text-xs text-indigo-600 font-medium mb-1">Tanggal Lahir</p>
                    <p class="text-gray-800 font-medium">
                        ${new Date(penghuni.tanggal_lahir).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                    </p>
                </div>
                <div class="bg-indigo-50/50 p-4 rounded-xl">
                    <p class="text-xs text-indigo-600 font-medium mb-1">Pekerjaan</p>
                    <p class="text-gray-800 font-medium">${penghuni.pekerjaan || 'Lainnya'}</p>
                </div>
                <div class="bg-indigo-50/50 p-4 rounded-xl">
                    <p class="text-xs text-indigo-600 font-medium mb-1">No. Kontak</p>
                    <p class="text-gray-800 font-medium">${penghuni.kontak || '-'}</p>
                </div>
                <div class="bg-indigo-50/50 p-4 rounded-xl md:col-span-2">
                    <p class="text-xs text-indigo-600 font-medium mb-1">Kontak Darurat</p>
                    <p class="text-gray-800 font-medium">${penghuni.kontak_darurat || '-'}</p>
                </div>
                <div class="bg-indigo-50/50 p-4 rounded-xl md:col-span-2">
                    <p class="text-xs text-indigo-600 font-medium mb-1">Bergabung Sejak</p>
                    <p class="text-gray-800 font-medium">
                        ${new Date(penghuni.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                    </p>
                </div>
            </div>
        `;

        document.getElementById('detailContent').innerHTML = detailHtml;

        const modal = document.getElementById('detailModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Fungsi untuk membuka modal edit
    function openEditModal(id) {
        const penghuni = penghuniData.find(p => p.id === id);
        if (!penghuni) return;

        const user = userData.find(u => u.id === penghuni.users_id);

        // Set modal title
        document.getElementById('modalTitle').innerHTML = '<i class="bx bx-edit text-indigo-600"></i> Edit Penghuni: ' + penghuni.nama;

        // Set user ID
        document.getElementById('editUserId').value = penghuni.users_id;

        // Isi data user
        document.getElementById('edit_nama').value = user?.nama || '';
        document.getElementById('edit_email').value = user?.email || '';
        document.getElementById('edit_password').value = ''; // Kosongkan password

        // Isi data penghuni
        document.getElementById('edit_penghuni_nama').value = penghuni.nama;
        document.getElementById('edit_kelamin').value = penghuni.kelamin;
        document.getElementById('edit_tanggal_lahir').value = penghuni.tanggal_lahir;
        document.getElementById('edit_pekerjaan').value = penghuni.pekerjaan;
        document.getElementById('edit_kontak').value = penghuni.kontak;
        document.getElementById('edit_kontak_darurat').value = penghuni.kontak_darurat;

        // Set form action untuk update (menggunakan route yang benar)
        document.getElementById('editForm').action = "{{ route('admin.account.update', ':id') }}".replace(':id', penghuni.users_id);

        // Tampilkan modal
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Fungsi konfirmasi hapus
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data penghuni akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Tutup modal saat klik di luar
    window.onclick = function(event) {
        const detailModal = document.getElementById('detailModal');
        const editModal = document.getElementById('editModal');

        if (event.target === detailModal) {
            closeDetailModal();
        }
        if (event.target === editModal) {
            closeEditModal();
        }
    }

    // Sinkronisasi nama akun dengan nama penghuni
    document.getElementById('edit_nama')?.addEventListener('input', function(e) {
        document.getElementById('edit_penghuni_nama').value = e.target.value;
    });
</script>
@endpush
