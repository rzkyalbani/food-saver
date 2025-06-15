<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    {{-- Breadcrumb sederhana --}}
                    <div class="mb-4 text-sm">
                        <a href="{{ route('home') }}" class="text-primary hover:text-primary-dark">Home</a> &gt;
                        <a href="{{ route('offers.index') }}" class="text-primary hover:text-primary-dark">Katalog</a>
                        &gt;
                        <span class="text-gray-500">{{ $offer->name }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Kolom Kiri - Detail Penawaran --}}
                        <div>
                            {{-- Placeholder gambar dengan overlay gradient dan badge --}}
                            <div class="relative h-72 sm:h-96 bg-gray-200 rounded-xl overflow-hidden">
                                @if ($offer->image)
                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent rounded-xl">
                                </div>

                                <!-- Badge waktu pengambilan -->
                                <div
                                    class="absolute bottom-3 left-3 bg-white/90 text-primary-dark px-2 py-1 rounded-md text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($offer->pickup_start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($offer->pickup_end_time)->format('H:i') }}
                                </div>

                                <!-- Badge stok -->
                                <div
                                    class="absolute top-3 right-3 bg-primary text-white px-2 py-1 rounded-md text-sm font-medium">
                                    {{ $offer->quantity_remaining }} tersisa
                                </div>
                            </div>

                            <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $offer->name }}</h1>
                            <p class="text-md text-gray-500 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a href="#"
                                    class="text-primary hover:text-primary-dark">{{ $offer->store->name }}</a>
                            </p>

                            <div class="bg-primary-light/20 p-4 rounded-lg mb-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-primary-dark ml-2">Tentang Penawaran Ini</h3>
                                </div>
                                <div class="prose max-w-none text-gray-700">
                                    {!! nl2br(e($offer->description)) ?: '<p><em>Tidak ada deskripsi untuk penawaran ini.</em></p>' !!}
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Jadwal Pengambilan</h3>
                                </div>
                                <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-md">
                                    Harap ambil pesanan Anda antara: <br>
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($offer->pickup_start_time)->translatedFormat('l, d M Y, H:i') }}</span><br>
                                    hingga <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($offer->pickup_end_time)->translatedFormat('l, d M Y, H:i') }}</span>.
                                </p>
                            </div>

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Lokasi Pengambilan</h3>
                                </div>
                                <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-md mb-2">
                                    {{ $offer->store->address }}</p>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($offer->store->latitude . ',' . $offer->store->longitude) }}"
                                    target="_blank"
                                    class="inline-flex items-center text-sm text-primary hover:text-primary-dark font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path
                                            d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    Lihat di Google Maps
                                </a>
                            </div>
                        </div>

                        {{-- Kolom Kanan - Aksi Pembelian --}}
                        <div class="sticky top-24 self-start">
                            <div class="bg-gray-50 rounded-lg shadow-md p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="text-3xl font-bold text-primary-dark">Rp
                                            {{ number_format($offer->discounted_price) }}</span>
                                        @if ($offer->original_price > $offer->discounted_price)
                                            <div class="flex items-center gap-1 mt-1">
                                                <span class="text-sm text-gray-500 line-through">Rp
                                                    {{ number_format($offer->original_price) }}</span>
                                                <span
                                                    class="text-xs font-medium bg-secondary-light/30 text-secondary-dark px-2 py-1 rounded-md">
                                                    Hemat
                                                    {{ round((($offer->original_price - $offer->discounted_price) / $offer->original_price) * 100) }}%
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <div
                                        class="bg-primary-light/30 text-primary-dark px-3 py-2 rounded-md text-sm font-medium">
                                        Value: Rp {{ number_format($offer->original_price) }}
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-center space-x-2 mb-6 bg-gray-100 py-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-semibold">{{ $offer->quantity_remaining }}</span>
                                    <span class="text-sm text-gray-600">tersisa dari</span>
                                    <span class="font-semibold">{{ $offer->quantity_initial }}</span>
                                </div>

                                @if ($offer->quantity_remaining > 0)
                                    @auth
                                        @if (Auth::user()->role !== 'store_owner')
                                            <form action="{{ route('order.store', $offer) }}" method="POST">
                                                @csrf
                                                <x-button variant="primary" size="lg" class="w-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path
                                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                                    </svg>
                                                    Pesan Sekarang
                                                </x-button>
                                            </form>
                                            <p class="text-xs text-gray-500 mt-4 text-center">
                                                Anda akan diarahkan ke halaman pembayaran setelah menekan tombol pesan.
                                            </p>
                                        @else
                                            <div class="bg-gray-100 rounded-md p-3 text-center text-gray-600 text-sm mb-3">
                                                Akun mitra tidak dapat melakukan pembelian.
                                            </div>
                                            <button type="button"
                                                class="w-full py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md cursor-not-allowed"
                                                disabled>
                                                Pesan Sekarang
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="block w-full text-center py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-md transition duration-300">
                                            Login untuk Memesan
                                        </a>
                                        <p class="text-xs text-gray-500 mt-3 text-center">
                                            Belum punya akun? <a href="{{ route('register') }}"
                                                class="text-primary hover:text-primary-dark">Daftar Sekarang</a>
                                        </p>
                                    @endauth
                                @else
                                    <div
                                        class="bg-gray-100 rounded-md p-3 text-center text-secondary mb-3 font-medium">
                                        Maaf, stok penawaran ini telah habis.
                                    </div>
                                    <button type="button"
                                        class="w-full py-3 bg-gray-300 text-gray-500 font-semibold rounded-lg shadow-md cursor-not-allowed"
                                        disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
