<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Penawaran Tersedia') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="relative" id="location-container">
                    <button id="getLocationBtn" type="button"
                        class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Gunakan Lokasi Saat Ini
                    </button>
                    <!-- Tambahkan tooltip lokasi -->
                    <div id="location-status"
                        class="hidden absolute left-0 -bottom-10 bg-white shadow-lg rounded-md p-2 text-sm text-gray-700 w-64 z-10">
                        <span id="location-message">Lokasi belum diatur</span>
                    </div>
                </div>

                <div>
                    <form action="{{ route('offers.index') }}" method="GET">
                        <div class="flex">
                            <div class="relative flex-grow">
                                <input type="text" name="search" placeholder="Cari penawaran..."
                                    class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50"
                                    value="{{ request('search') }}">
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Filter & Urutkan</h3>

                            @if (Session::has('user_lat') && Session::has('user_lon'))
                                <div class="text-sm text-gray-600">
                                    <span class="inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mr-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Lokasi saat ini digunakan
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <a href="{{ route('offers.index', ['sort' => 'distance'] + request()->except(['sort', 'page'])) }}"
                                class="px-3 py-1 rounded-full text-sm {{ request('sort') == 'distance' || !request('sort') ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Terdekat
                            </a>
                            <a href="{{ route('offers.index', ['sort' => 'price_low'] + request()->except(['sort', 'page'])) }}"
                                class="px-3 py-1 rounded-full text-sm {{ request('sort') == 'price_low' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Harga Terendah
                            </a>
                            <a href="{{ route('offers.index', ['sort' => 'price_high'] + request()->except(['sort', 'page'])) }}"
                                class="px-3 py-1 rounded-full text-sm {{ request('sort') == 'price_high' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Harga Tertinggi
                            </a>
                            <a href="{{ route('offers.index', ['sort' => 'discount'] + request()->except(['sort', 'page'])) }}"
                                class="px-3 py-1 rounded-full text-sm {{ request('sort') == 'discount' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Diskon Terbesar
                            </a>
                        </div>
                    </div>

                    @if (count($offers) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($offers as $offer)
                                <a href="{{ route('offers.show', $offer) }}" class="group">
                                    <div
                                        class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <div class="relative h-48 bg-gray-200">
                                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                                @if ($offer->image)
                                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->name }}"
                                                        class="w-full h-full object-cover">
                                                @endif
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                                </div>

                                                <!-- Badge diskon -->
                                                <div
                                                    class="absolute top-3 left-3 bg-primary text-white px-2 py-1 rounded-md text-xs font-medium">
                                                    @php
                                                        $discount = round(
                                                            (($offer->original_price - $offer->discounted_price) /
                                                                $offer->original_price) *
                                                                100,
                                                        );
                                                    @endphp
                                                    {{ $discount }}% OFF
                                                </div>

                                                <!-- Badge waktu pengambilan -->
                                                <div
                                                    class="absolute bottom-3 left-3 bg-white/90 text-primary-dark px-2 py-1 rounded-md text-xs font-medium">
                                                    {{ \Carbon\Carbon::parse($offer->pickup_start_time)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($offer->pickup_end_time)->format('H:i') }}
                                                </div>

                                                <!-- Badge stok -->
                                                <div
                                                    class="absolute top-3 right-3 bg-primary text-white px-2 py-1 rounded-md text-xs font-medium">
                                                    {{ $offer->quantity_remaining }} tersisa
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-4">
                                            <!-- Info toko -->
                                            <div class="text-sm text-gray-500 mb-1">{{ $offer->store->name }}</div>

                                            <!-- Nama penawaran -->
                                            <h3
                                                class="text-lg font-semibold text-gray-800 group-hover:text-primary transition-colors">
                                                {{ $offer->name }}
                                            </h3>

                                            <!-- Harga -->
                                            <div class="mt-2 flex items-baseline">
                                                <span class="text-lg font-bold text-primary">Rp
                                                    {{ number_format($offer->discounted_price, 0, ',', '.') }}</span>
                                                <span class="ml-2 text-sm text-gray-500 line-through">Rp
                                                    {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                                            </div>

                                            <!-- Jarak -->
                                            @if (isset($offer->distance))
                                                <div class="mt-2 text-sm text-gray-500 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 mr-1 text-gray-400" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    @if ($offer->distance < 1)
                                                        {{ round($offer->distance * 1000) }} m
                                                    @else
                                                        {{ number_format($offer->distance, 1) }} km
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $offers->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                @if (isset($search) && $search)
                                    Tidak ada penawaran yang cocok dengan pencarian "<span
                                        class="font-semibold">{{ $search }}</span>".
                                @else
                                    Belum ada penawaran tersedia.
                                @endif
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Coba kata kunci lain atau cek kembali nanti.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('getLocationBtn').addEventListener('click', function() {
                const button = this;
                const locationStatus = document.getElementById('location-status');
                const locationMessage = document.getElementById('location-message');

                // Tampilkan status lokasi
                locationStatus.classList.remove('hidden');

                // Tampilkan animasi loading
                button.disabled = true;
                button.innerHTML = `
                    <div class="flex items-center">
                        <svg class="animate-spin h-4 w-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Mencari lokasi...</span>
                    </div>`;

                locationMessage.textContent = "Sedang mencari lokasi Anda...";

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            locationMessage.textContent = "Menyimpan lokasi Anda...";

                            fetch('{{ route('set.location') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        latitude: lat,
                                        longitude: lng
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        locationMessage.innerHTML = `
                                        <span class="text-green-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Lokasi berhasil diperbarui!
                                        </span>`;

                                        // Tunggu sebentar sebelum refresh halaman
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1000);
                                    } else {
                                        showLocationError('Gagal menyimpan lokasi. Silakan coba lagi.');
                                    }
                                })
                                .catch(() => {
                                    showLocationError('Terjadi kesalahan saat menghubungi server.');
                                });
                        },
                        function(error) {
                            let message = '';
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    message =
                                        "Anda menolak akses lokasi. Mohon izinkan akses lokasi di pengaturan browser Anda.";
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    message = "Informasi lokasi tidak tersedia. Pastikan GPS Anda aktif.";
                                    break;
                                case error.TIMEOUT:
                                    message = "Waktu permintaan untuk mendapatkan lokasi habis. Silakan coba lagi.";
                                    break;
                                case error.UNKNOWN_ERROR:
                                    message = "Terjadi kesalahan yang tidak diketahui. Silakan coba lagi.";
                                    break;
                            }
                            showLocationError(message);
                        },
                        // Options
                        {
                            enableHighAccuracy: true,
                            timeout: 10000, // 10 detik
                            maximumAge: 0
                        }
                    );
                } else {
                    showLocationError('Browser Anda tidak mendukung geolokasi.');
                }
            });

            function showLocationError(message) {
                const locationMessage = document.getElementById('location-message');
                const button = document.getElementById('getLocationBtn');

                locationMessage.innerHTML = `
                    <span class="text-red-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        ${message}
                    </span>`;

                // Reset button
                button.disabled = false;
                button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Gunakan Lokasi Saat Ini`;

                // Sembunyikan pesan error setelah 5 detik
                setTimeout(() => {
                    if (document.getElementById('location-status')) {
                        document.getElementById('location-status').classList.add('hidden');
                    }
                }, 5000);
            }

            // Tutup tooltip saat klik di luar
            document.addEventListener('click', function(event) {
                const locationStatus = document.getElementById('location-status');
                const locationBtn = document.getElementById('getLocationBtn');
                const locationContainer = document.getElementById('location-container');

                if (locationStatus && !locationStatus.classList.contains('hidden') &&
                    !locationContainer.contains(event.target) && event.target !== locationBtn) {
                    locationStatus.classList.add('hidden');
                }
            });
        </script>
    @endpush
</x-app-layout>
