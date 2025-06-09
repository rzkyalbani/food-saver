<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mitra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-text-dark">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-text-gray">Ini adalah pusat kendali untuk bisnis Anda. Kelola penawaran, pantau pesanan, dan lihat pertumbuhan bisnis Anda di Food Saver.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-primary-green/10 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-text-gray">Penawaran Aktif</p>
                        <p class="text-2xl font-bold text-text-dark">0</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-accent-yellow/10 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-yellow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-text-gray">Terjual Hari Ini</p>
                        <p class="text-2xl font-bold text-text-dark">0</p>
                    </div>
                </div>

                 <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-blue-500/10 p-3 rounded-full">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-text-gray">Pendapatan (Bulan Ini)</p>
                        <p class="text-2xl font-bold text-text-dark">Rp 0</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-purple-500/10 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-text-gray">Rating Rata-rata</p>
                        <p class="text-2xl font-bold text-text-dark">N/A</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>