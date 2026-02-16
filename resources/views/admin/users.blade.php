@extends('layouts.app')

@section('title', 'Management Account')

@section('content')
<div class="main-content">
    <!-- Header Section -->
    <div class="mb-6 flex flex-wrap items-center justify-between">
        <h4 class="text-xl font-semibold text-slate-800">Management Account</h4>
        <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300" data-bs-toggle="modal" data-bs-target="#addAccountModal">
            <i class="feather feather-plus me-1"></i> Tambah Account
        </button>
    </div>

    <!-- Modal Form Tambah Account -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="addAccountModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('account.store') }}" id="formAccount">
                    @csrf
                    <div class="modal-body p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Card Kiri - Informasi Akun -->
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-200">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="feather feather-user text-blue-600"></i>
                                    </div>
                                    <h6 class="text-sm font-bold uppercase text-slate-500">Informasi Akun</h6>
                                </div>

                                <!-- Nama -->
                                <div class="mb-4">
                                    <label class="flex items-center gap-1 mb-2 text-xs font-bold uppercase text-slate-400">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="feather feather-user text-gray-400" style="font-size: 16px;"></i>
                                        </div>
                                        <input type="text" name="nama" value="{{ old('nama') }}"
                                            class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    @error('nama')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-2">
                                    <label class="flex items-center gap-1 mb-2 text-xs font-bold uppercase text-slate-400">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="feather feather-mail text-gray-400" style="font-size: 16px;"></i>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                            placeholder="nama@email.com" required>
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Card Kanan - Keamanan & Role -->
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-200">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="feather feather-shield text-green-600"></i>
                                    </div>
                                    <h6 class="text-sm font-bold uppercase text-slate-500">Keamanan & Role</h6>
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label class="flex items-center gap-1 mb-2 text-xs font-bold uppercase text-slate-400">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="feather feather-lock text-gray-400" style="font-size: 16px;"></i>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="w-full pl-10 pr-12 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                            placeholder="Minimal 8 karakter" required minlength="8">
                                        <button type="button"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password', this)">
                                            <i class="feather feather-eye"></i>
                                        </button>
                                    </div>
                                    <div id="passwordStrength" class="mt-2 hidden">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="strength-bar h-full transition-all duration-300 w-0"></div>
                                            </div>
                                            <span class="strength-text text-xs"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-4">
                                    <label class="flex items-center gap-1 mb-2 text-xs font-bold uppercase text-slate-400">
                                        Konfirmasi Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="feather feather-lock text-gray-400" style="font-size: 16px;"></i>
                                        </div>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="w-full pl-10 pr-12 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                            placeholder="Ulangi password" required>
                                        <button type="button"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password_confirmation', this)">
                                            <i class="feather feather-eye"></i>
                                        </button>
                                    </div>
                                    <p id="passwordMessage" class="text-xs mt-2 flex items-center gap-1"></p>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label class="flex items-center gap-1 mb-2 text-xs font-bold uppercase text-slate-400">
                                        Role <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="feather feather-users text-gray-400" style="font-size: 16px;"></i>
                                        </div>
                                        <select name="role"
                                            class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none bg-white"
                                            required>
                                            <option value="" disabled selected>Pilih Role</option>
                                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                                            <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staf</option>
                                            <option value="penghuni" {{ old('role') == 'penghuni' ? 'selected' : '' }}>Penghuni</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <i class="feather feather-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Account dari Database -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Account</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group w-auto">
                            <input type="text" class="form-control form-control-sm" placeholder="Cari..." id="searchTable">
                            <button class="btn btn-sm btn-outline-primary" type="button"><i class="feather feather-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover" id="accountTable">
                            <thead>
                                <tr>
                                    <th class="wd-30">
                                        <div class="btn-group mb-1">
                                            <div class="custom-control custom-checkbox ms-1">
                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                <label class="custom-control-label" for="checkAll"></label>
                                            </div>
                                        </div>
                                    </th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $account)
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox" id="checkBox_{{ $account->id }}" value="{{ $account->id }}">
                                                <label class="custom-control-label" for="checkBox_{{ $account->id }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md bg-{{ ['primary', 'success', 'warning', 'info', 'teal'][$account->id % 5] }} text-white d-flex align-items-center justify-content-center rounded-circle">
                                                {{ strtoupper(substr($account->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line fw-semibold">{{ $account->nama }}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td><a href="mailto:{{ $account->email }}">{{ $account->email }}</a></td>
                                    <td>
                                        @php
                                            $roleColors = [
                                                'owner' => 'bg-purple-100 text-purple-800',
                                                'staf' => 'bg-blue-100 text-blue-800',
                                                'penghuni' => 'bg-green-100 text-green-800'
                                            ];
                                            $roleLabels = [
                                                'owner' => 'Owner',
                                                'staf' => 'Staf',
                                                'penghuni' => 'Penghuni'
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $roleColors[$account->role] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $roleLabels[$account->role] ?? ucfirst($account->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $account->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $account->created_at->diffInDays(now()) < 30 ? 'success' : 'warning' }}-subtle text-{{ $account->created_at->diffInDays(now()) < 30 ? 'success' : 'warning' }} rounded-pill">
                                            {{ $account->created_at->diffInDays(now()) < 30 ? 'Aktif' : 'Lama' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" onclick="editAccount({{ $account->id }})" data-bs-toggle="tooltip" title="Edit">
                                                <i class="feather feather-edit-3"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" onclick="viewAccount({{ $account->id }})" data-bs-toggle="tooltip" title="Detail">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editAccount({{ $account->id }})">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="resetPassword({{ $account->id }})">
                                                            <i class="feather feather-key me-3"></i>
                                                            <span>Reset Password</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteAccount({{ $account->id }})">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Hapus</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(isset($accounts) && $accounts->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        {{ $accounts->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Account -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editForm" class="edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body p-6">
                    <!-- Form edit akan diisi melalui JavaScript -->
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200" data-bs-dismiss="modal">
                    Batal
                </button>
                <form method="POST" action="" id="deleteForm" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="resetPasswordForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p>Password akan direset menjadi: <strong>password123</strong></p>
                    <p class="text-sm text-gray-500">User dapat mengganti password setelah login.</p>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-warning-600 rounded-lg hover:bg-warning-700">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(id, button) {
        const input = document.getElementById(id);
        const icon = button.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('feather-eye');
            icon.classList.add('feather-eye-off');
        } else {
            input.type = "password";
            icon.classList.remove('feather-eye-off');
            icon.classList.add('feather-eye');
        }
    }

    // Password strength checker
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("password_confirmation");
    const message = document.getElementById("passwordMessage");
    const strengthContainer = document.getElementById("passwordStrength");
    const strengthBar = document.querySelector(".strength-bar");
    const strengthText = document.querySelector(".strength-text");

    if (password) {
        password.addEventListener("input", function() {
            const val = this.value;
            if (!val) {
                strengthContainer.classList.add("hidden");
                return;
            }

            strengthContainer.classList.remove("hidden");

            let strength = 0;
            if (val.length >= 8) strength += 25;
            if (/\d/.test(val)) strength += 25;
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) strength += 25;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(val)) strength += 25;

            strengthBar.style.width = strength + "%";

            if (strength <= 25) {
                strengthBar.className = "strength-bar h-full transition-all duration-300 bg-red-500";
                strengthText.textContent = "Lemah";
                strengthText.className = "strength-text text-xs text-red-500";
            } else if (strength <= 50) {
                strengthBar.className = "strength-bar h-full transition-all duration-300 bg-yellow-500";
                strengthText.textContent = "Cukup";
                strengthText.className = "strength-text text-xs text-yellow-600";
            } else if (strength <= 75) {
                strengthBar.className = "strength-bar h-full transition-all duration-300 bg-blue-500";
                strengthText.textContent = "Baik";
                strengthText.className = "strength-text text-xs text-blue-600";
            } else {
                strengthBar.className = "strength-bar h-full transition-all duration-300 bg-green-500";
                strengthText.textContent = "Kuat";
                strengthText.className = "strength-text text-xs text-green-600";
            }

            if (confirmPassword && confirmPassword.value) checkPasswordMatch();
        });
    }

    // Check password match
    function checkPasswordMatch() {
        if (!confirmPassword.value) {
            message.classList.add("hidden");
            confirmPassword.classList.remove("border-green-500", "border-red-500");
            return;
        }

        if (password.value === confirmPassword.value) {
            message.innerHTML = '<i class="feather feather-check-circle text-green-500" style="font-size: 14px;"></i> Password cocok';
            message.className = "text-xs mt-2 flex items-center gap-1 text-green-600";
            confirmPassword.classList.remove("border-red-500");
            confirmPassword.classList.add("border-green-500");
        } else {
            message.innerHTML = '<i class="feather feather-x-circle text-red-500" style="font-size: 14px;"></i> Password tidak cocok';
            message.className = "text-xs mt-2 flex items-center gap-1 text-red-600";
            confirmPassword.classList.remove("border-green-500");
            confirmPassword.classList.add("border-red-500");
        }
    }

    if (confirmPassword) {
        confirmPassword.addEventListener("input", checkPasswordMatch);
    }

    // Search table functionality
    document.getElementById('searchTable')?.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#accountTable tbody tr');

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Check all checkbox
    document.getElementById('checkAll')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    // Edit account function
    window.editAccount = function(id) {
        fetch(`/account/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const modal = new bootstrap.Modal(document.getElementById('editAccountModal'));
                const form = document.getElementById('editForm');
                form.action = `/account/${id}`;

                // Isi form dengan data
                document.querySelector('#editAccountModal .modal-body').innerHTML = `
                    <div class="mb-4">
                        <label class="block mb-2 text-xs font-bold uppercase text-slate-400">Nama Lengkap</label>
                        <input type="text" name="nama" value="${data.nama}" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-xs font-bold uppercase text-slate-400">Email</label>
                        <input type="email" name="email" value="${data.email}" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-xs font-bold uppercase text-slate-400">Role</label>
                        <select name="role" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="owner" ${data.role === 'owner' ? 'selected' : ''}>Owner</option>
                            <option value="staf" ${data.role === 'staf' ? 'selected' : ''}>Staf</option>
                            <option value="penghuni" ${data.role === 'penghuni' ? 'selected' : ''}>Penghuni</option>
                        </select>
                    </div>
                `;

                modal.show();
            });
    };

    // Delete account function
    window.deleteAccount = function(id) {
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        document.getElementById('deleteForm').action = `/account/${id}`;
        modal.show();
    };

    // Reset password function
    window.resetPassword = function(id) {
        const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
        document.getElementById('resetPasswordForm').action = `/account/${id}/reset-password`;
        modal.show();
    };

    // View account function
    window.viewAccount = function(id) {
        window.location.href = `/account/${id}`;
    };

    // Initialize tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });
</script>
@endpush
