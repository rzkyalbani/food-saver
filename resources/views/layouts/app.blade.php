<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Food Saver') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Custom Styles -->
    <style>
        .location-tooltip {
            position: absolute;
            z-index: 1000;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 0.5rem;
            font-size: 0.875rem;
            max-width: 20rem;
            display: none;
        }

        .notification-toast {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 9999;
            padding: 1rem;
            border-radius: 0.375rem;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            max-width: 24rem;
            transform: translateY(150%);
            transition: transform 0.3s ease-out;
        }

        .notification-toast.show {
            transform: translateY(0);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Notification Toast -->
        <div id="notification-toast" class="notification-toast">
            <div id="notification-content"></div>
            <button type="button" class="ml-auto text-gray-400 hover:text-gray-500" id="close-notification">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'info') {
            const toast = document.getElementById('notification-toast');
            const content = document.getElementById('notification-content');

            // Set konten notifikasi
            let icon = '';
            let textColor = '';

            switch (type) {
                case 'success':
                    icon =
                        '<svg class="h-5 w-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>';
                    textColor = 'text-green-800';
                    break;
                case 'error':
                    icon =
                        '<svg class="h-5 w-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>';
                    textColor = 'text-red-800';
                    break;
                case 'warning':
                    icon =
                        '<svg class="h-5 w-5 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>';
                    textColor = 'text-yellow-800';
                    break;
                default:
                    icon =
                        '<svg class="h-5 w-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>';
                    textColor = 'text-blue-800';
            }

            content.innerHTML = `<div class="flex items-center ${textColor}">${icon}${message}</div>`;

            // Tampilkan notifikasi
            toast.classList.add('show');

            // Otomatis hilangkan setelah 5 detik
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        // Event listener untuk tombol tutup notifikasi
        document.getElementById('close-notification').addEventListener('click', function() {
            document.getElementById('notification-toast').classList.remove('show');
        });

        // Deteksi apakah ada pesanan yang mendekati waktu pengambilan
        document.addEventListener('DOMContentLoaded', function() {
            @auth
            // Jika pengguna login, periksa adanya pesanan yang perlu diambil
            @if (Auth::user()->orders()->where('status', 'paid')->count() > 0)
                // Hanya tampilkan notifikasi pengambilan jika berada di halaman yang bukan order-success
                if (!window.location.pathname.includes('order-success')) {
                    setTimeout(() => {
                        showNotification(
                            'Anda memiliki pesanan yang siap diambil. Silakan cek dashboard Anda.',
                            'info');
                    }, 2000);
                }
            @endif
        @endauth

        // Timeline toggle - perbaikan
        const toggleButtons = document.querySelectorAll('.toggle-timeline');
        if (toggleButtons.length > 0) {
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const targetElement = document.getElementById(targetId);
                    const iconElement = this.querySelector('.toggle-icon');

                    if (targetElement.classList.contains('hidden')) {
                        targetElement.classList.remove('hidden');
                        iconElement.style.transform = 'rotate(180deg)';

                        // Ubah teks jika ada elemen span
                        const spanElement = this.querySelector('span');
                        if (spanElement) {
                            spanElement.textContent = 'Sembunyikan Status Pesanan';
                        }
                    } else {
                        targetElement.classList.add('hidden');
                        iconElement.style.transform = 'rotate(0)';

                        // Ubah teks jika ada elemen span
                        const spanElement = this.querySelector('span');
                        if (spanElement) {
                            spanElement.textContent = 'Lihat Status Pesanan';
                        }
                    }
                });
            });
        }
        });
    </script>

    @stack('scripts')
</body>

</html>
