<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tailwind CDN v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Flowbite CSS & JS (untuk modal) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: #f8fafc;
        }
        button {
            pointer-events: auto !important;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- ========== DESKTOP NAVBAR ========== -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 hidden md:block">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                        <i class='bx bx-home-alt-2 text-white text-lg'></i>
                    </div>
                    <span class="text-xl font-semibold text-gray-800">Kos<span class="text-indigo-600">an</span></span>
                    <span class="hidden lg:inline-block ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">#NyamanSepertiRumah</span>
                </div>

                <!-- Desktop Menu -->
                <div class="flex items-center space-x-8">
                    <a href="/beranda" class="text-gray-700 hover:text-indigo-600 transition font-medium">Beranda</a>
                    <a href="/kamar" class="text-gray-700 hover:text-indigo-600 transition font-medium">Kamar</a>
                    <a href="/kamar-saya" class="text-gray-700 hover:text-indigo-600 transition font-medium">Kamar Saya</a>
                    <a href="/chat" class="text-gray-700 hover:text-indigo-600 transition font-medium">Chat</a>
                    <a href="/profile" class="text-gray-700 hover:text-indigo-600 transition font-medium">Profile</a>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    <button class="relative p-2 text-indigo-600 hover:bg-indigo-50 rounded-full">
                        <i class='bx bx-bell text-xl'></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-rose-500 rounded-full"></span>
                    </button>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-200 to-emerald-200 flex items-center justify-center text-indigo-700 font-medium border-2 border-white shadow-sm">
                        <span class="text-sm">AF</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ========== BOTTOM NAVIGATION MOBILE ========== -->
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.05)] rounded-t-2xl z-50 py-2 px-2 md:hidden">
        <div class="flex justify-around items-center">
            <a href="/beranda" class="flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500">
                <i class='bx bx-home-alt text-xl'></i>
                <span>Beranda</span>
            </a>
            <a href="/kamar" class="flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500">
                <i class='bx bx-grid-alt text-xl'></i>
                <span>Kamar</span>
            </a>
            <a href="/kamar-saya" class="flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500">
                <i class='bx bx-bed text-xl'></i>
                <span>Kamar Saya</span>
            </a>
            <a href="/chat" class="flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500">
                <i class='bx bx-chat text-xl'></i>
                <span>Chat</span>
            </a>
            <a href="/profile" class="flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500">
                <i class='bx bx-user text-xl'></i>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <div class="pb-16 md:pb-0">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
