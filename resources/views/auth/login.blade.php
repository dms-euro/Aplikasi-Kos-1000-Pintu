<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Kosan优雅</title>
    <!-- Tailwind CDN v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Background Decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white shadow-xl mb-4 transform hover:scale-105 transition-transform duration-300">
                <i class='bx bx-home-alt-2 text-4xl text-indigo-600'></i>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang</h2>
            <p class="text-indigo-100">Silakan login untuk melanjutkan</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class='bx bx-envelope align-middle text-indigo-500 mr-1'></i>
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-envelope text-gray-400'></i>
                        </div>
                        <input type="email"
                               name="email"
                               id="email"
                               class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50"
                               placeholder="nama@email.com"
                               required>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class='bx bx-lock-alt align-middle text-indigo-500 mr-1'></i>
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-lock-alt text-gray-400'></i>
                        </div>
                        <input type="password"
                               name="password"
                               id="password"
                               class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50"
                               placeholder="••••••••"
                               required>
                        <button type="button"
                                onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class='bx bx-hide text-gray-400 hover:text-indigo-600 transition-colors duration-200' id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline transition-colors duration-200">
                        Lupa password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-xl font-medium hover:from-indigo-700 hover:to-purple-700 focus:ring-4 focus:ring-indigo-300 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                    <i class='bx bx-log-in mr-2 align-middle'></i>
                    Login
                </button>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="register.html" class="text-indigo-600 hover:text-indigo-700 font-medium hover:underline transition-colors duration-200">
                        Daftar sekarang
                    </a>
                </p>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                <p class="text-xs text-indigo-600 font-medium mb-2">
                    <i class='bx bx-info-circle align-middle mr-1'></i>
                    Demo Credentials:
                </p>
                <div class="space-y-1 text-sm">
                    <p class="text-gray-600"><span class="font-medium">Owner:</span> owner@kosan.id / owner123</p>
                    <p class="text-gray-600"><span class="font-medium">Staff:</span> staff@kosan.id / staff123</p>
                    <p class="text-gray-600"><span class="font-medium">Penghuni:</span> penghuni@kosan.id / penghuni123</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-indigo-200 text-sm mt-8">
            © 2026 Kosan优雅. All rights reserved.
        </p>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById('togglePasswordIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bx bx-show text-gray-400 hover:text-indigo-600';
            } else {
                input.type = 'password';
                icon.className = 'bx bx-hide text-gray-400 hover:text-indigo-600';
            }
        }

        function handleLogin(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Simulasi login berdasarkan role
            if (email === 'owner@kosan.id' && password === 'owner123') {
                window.location.href = 'dashboard-owner.html';
            } else if (email === 'staff@kosan.id' && password === 'staff123') {
                window.location.href = 'dashboard-staff.html';
            } else if (email === 'penghuni@kosan.id' && password === 'penghuni123') {
                window.location.href = 'dashboard-penghuni.html';
            } else {
                alert('Email atau password salah! Silakan coba lagi.');
            }
        }
    </script>

</body>
</html>
