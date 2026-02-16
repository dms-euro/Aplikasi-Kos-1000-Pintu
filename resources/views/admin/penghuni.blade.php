@extends('layouts.app')
@section('title', 'Penghuni | Bapak Kos')
@section('content')

    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-indigo-50/70 text-indigo-800">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">ID</th>
                        <th class="px-6 py-3 text-left font-medium">Nama</th>
                        <th class="px-6 py-3 text-left font-medium">Email</th>
                        <th class="px-6 py-3 text-left font-medium">Role</th>
                        <th class="px-6 py-3 text-left font-medium">Created At</th>
                        <th class="px-6 py-3 text-left font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-100">
                    @forelse($user as $item)
                        <tr class="hover:bg-indigo-50 transition">
                            <td class="px-6 py-3">{{ $item->id }}</td>
                            <td class="px-6 py-3">{{ $item->nama }}</td>
                            <td class="px-6 py-3">{{ $item->email }}</td>
                            <td class="px-6 py-3 capitalize">
                                <span
                                    class="px-2 py-1 text-xs rounded-full
                    @if ($item->role == 'owner') bg-green-100 text-green-700
                    @else bg-blue-100 text-blue-700 @endif">
                                    {{ $item->role }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 flex gap-2">
                                <!-- Tombol Delete -->
                                <form id="delete-form-{{ $item->id }}" action="{{ route('account.delete', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        <div class="px-6 py-3 border-t border-indigo-100 text-right text-xs text-indigo-400">
            total <span id="userCount">0</span> pengguna
        </div>
    </div>

@endsection
