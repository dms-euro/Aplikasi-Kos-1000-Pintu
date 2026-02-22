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

<body class="bg-indigo-50/20">

    <div class="flex h-screen overflow-hidden">
        @auth
            @if (auth()->user()->role === 'owner')
                @include('layouts.sidebar-owner')
            @endif

            @if (auth()->user()->role === 'staf')
                @include('layouts.sidebar-staf')
            @endif
        @endauth

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto bg-white/70 backdrop-blur-sm">

            @auth
                <!-- top bar -->
                @include('layouts.header')
            @endauth

            <!-- content -->
            @yield('content')

        </main>
    </div>

    <!-- Script -->
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'px-4 py-2 bg-red-600 text-white rounded-lg',
                    cancelButton: 'px-4 py-2 bg-gray-500 text-white rounded-lg ml-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</body>

</html>
