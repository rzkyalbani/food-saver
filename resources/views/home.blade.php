<x-app-layout>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hover effect untuk card */
        .offer-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .offer-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Pulse animation untuk badge diskon */
        .discount-badge {
            animation: pulse-discount 2s infinite;
        }

        @keyframes pulse-discount {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary/90 to-primary-dark py-16 mb-10 overflow-hidden">
        <!-- Elemen dekoratif -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full bg-white"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full bg-white"></div>
            <div class="absolute top-1/3 right-1/4 w-20 h-20 rounded-full bg-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Logo dan Brand Positioning yang Jelas -->
            <div class="flex items-center mb-6">
                <div class="bg-white/20 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Food Saver</h1>
                    <p class="text-white/80 text-sm">Platform Pengurangan Limbah Makanan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-white animate-on-scroll">
                    <div
                        class="inline-flex items-center px-3 py-1 bg-secondary/30 text-white rounded-full text-sm font-medium mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Terdaftar Resmi & Terpercaya
                    </div>

                    <!-- Headline yang Lebih Jelas & Deskriptif -->
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">Selamatkan Makanan,
                        <br>Hemat Hingga <span class="text-secondary">70%</span>
                    </h2>

                    <!-- Deskripsi yang Lebih Detil -->
                    <p class="text-lg mb-6 text-white/90 max-w-lg">
                        Food Saver menghubungkan Anda dengan restoran dan toko di sekitar yang menjual makanan berlebih
                        berkualitas dengan harga miring, sekaligus mengurangi limbah makanan.
                    </p>

                    <!-- Fitur-fitur Utama dalam Bullet Points -->
                    <ul class="mb-6">
                        <li class="flex items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary mr-2 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Temukan penawaran dari <b>toko-toko lokal</b> di sekitar Anda</span>
                        </li>
                        <li class="flex items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary mr-2 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Nikmati <b>diskon besar</b> untuk makanan berkualitas</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary mr-2 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Berkontribusi pada <b>pengurangan limbah makanan</b></span>
                        </li>
                    </ul>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('offers.index') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg text-primary-dark bg-white hover:bg-gray-100 shadow-md transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Jelajahi Penawaran Terdekat
                        </a>
                        <a href="#how-it-works"
                            class="inline-flex items-center px-6 py-3 border border-white text-base font-bold rounded-lg text-white hover:bg-white/10 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Cara Kerja
                        </a>
                    </div>

                    <!-- Trusted By Section -->
                    <div class="mt-8 py-3 px-4 bg-white/10 backdrop-blur-sm rounded-lg inline-flex items-center">
                        <span class="text-sm text-white mr-3">Telah digunakan oleh:</span>
                        <span class="text-xl font-bold text-white">10,000+ </span>
                        <span class="text-sm text-white/80 ml-1">pengguna di Indonesia</span>
                    </div>
                </div>

                <div class="hidden md:block">
                    <!-- Interactive visual element yang lebih informatif -->
                    <div class="bg-white/20 rounded-lg p-6 backdrop-blur-sm shadow-lg animate-on-scroll"
                        style="animation-delay: 0.3s">
                        <!-- Preview Penawaran - Lebih Representatif -->
                        <div class="relative mb-4">
                            <div class="relative rounded-lg overflow-hidden shadow-lg">
                                <img src="https://images.unsplash.com/photo-1483695028939-5bb13f8648b0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="w-full h-60 object-cover" alt="Food Offer Preview">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div
                                    class="absolute bottom-3 left-3 bg-secondary text-white px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                    70% OFF
                                </div>

                                <div
                                    class="absolute bottom-3 right-3 bg-white text-primary-dark px-2 py-1 rounded-md text-xs font-medium">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        14:00 - 18:00
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-4 mx-4 -mt-10 relative z-10 shadow-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-500">Bakery Sunshine</span>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-xs font-medium ml-1">4.8</span>
                                    </div>
                                </div>

                                <h3 class="font-bold text-gray-800">Paket Aneka Roti dan Pastry</h3>

                                <div class="flex items-end justify-between mt-2">
                                    <div>
                                        <span class="text-lg font-bold text-primary-dark">Rp 35.000</span>
                                        <span class="text-xs text-gray-500 line-through ml-1">Rp 120.000</span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        1.2 km
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Impact Counter yang Lebih Informatif -->
                        <div class="grid grid-cols-3 gap-2 mt-4">
                            <div class="bg-white/20 rounded-lg p-3">
                                <div class="text-xl font-bold text-white">5.2 ton</div>
                                <p class="text-xs text-white/90">CO₂ yang terhindar dari atmosfer</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-3">
                                <div class="text-xl font-bold text-white">10.000+</div>
                                <p class="text-xs text-white/90">Makanan terselamatkan bulan ini</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-3">
                                <div class="text-xl font-bold text-white">Rp35rb+</div>
                                <p class="text-xs text-white/90">Rata-rata penghematan per order</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Features Teaser -->
            <div class="grid grid-cols-2 gap-3 mt-6 md:mt-8">
                <div class="flex items-center bg-white/10 p-3 rounded-lg backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div class="text-white">
                        <h3 class="font-medium text-sm">Lokasi Terdekat</h3>
                        <p class="text-xs text-white/80">Radius pencarian disesuaikan</p>
                    </div>
                </div>
                <div class="flex items-center bg-white/10 p-3 rounded-lg backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-white">
                        <h3 class="font-medium text-sm">Waktu Fleksibel</h3>
                        <p class="text-xs text-white/80">Pilih sesuai jadwal Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50 rounded-xl mb-12" id="how-it-works">
        <div class="text-center mb-12 animate-on-scroll">
            <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium mb-2">Mudah
                Digunakan</span>
            <h2 class="text-3xl font-bold mb-4 text-primary-dark">Cara Kerja Food Saver</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Temukan, pesan, dan selamatkan makanan yang masih layak konsumsi
                namun akan dibuang, dengan harga diskon hingga 70% dari harga normal.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <!-- Connector lines for desktop -->
            <div class="hidden md:block absolute top-24 left-1/3 w-1/3 h-0.5 bg-primary"></div>
            <div class="hidden md:block absolute top-24 left-2/3 w-1/3 h-0.5 bg-primary"></div>

            <!-- Step 1 -->
            <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate-on-scroll"
                style="animation-delay: 0.2s">
                <div
                    class="bg-primary/10 text-primary inline-flex items-center justify-center w-16 h-16 rounded-full mb-6 mx-auto">
                    <span class="text-2xl font-bold">1</span>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Temukan</h3>
                <p class="text-gray-600 mb-4">Jelajahi penawaran makanan berkualitas dari toko dan restoran terdekat.
                    Gunakan filter berdasarkan lokasi, harga, atau jenis makanan.</p>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <ul class="text-sm text-left text-gray-600">
                        <li class="flex items-start mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Lihat foto makanan yang ditawarkan
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Cek jadwal pengambilan dan stok tersedia
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate-on-scroll"
                style="animation-delay: 0.4s">
                <div
                    class="bg-primary/10 text-primary inline-flex items-center justify-center w-16 h-16 rounded-full mb-6 mx-auto">
                    <span class="text-2xl font-bold">2</span>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Pesan & Bayar</h3>
                <p class="text-gray-600 mb-4">Pilih penawaran yang Anda inginkan, bayar dengan mudah menggunakan
                    berbagai metode pembayaran yang tersedia.</p>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <ul class="text-sm text-left text-gray-600">
                        <li class="flex items-start mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Pembayaran online aman dan cepat
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Dapatkan kode pengambilan unik
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate-on-scroll"
                style="animation-delay: 0.6s">
                <div
                    class="bg-primary/10 text-primary inline-flex items-center justify-center w-16 h-16 rounded-full mb-6 mx-auto">
                    <span class="text-2xl font-bold">3</span>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Ambil & Nikmati</h3>
                <p class="text-gray-600 mb-4">Kunjungi toko selama jam pengambilan yang ditentukan, tunjukkan kode
                    pesanan Anda, dan nikmati makanan lezat.</p>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <ul class="text-sm text-left text-gray-600">
                        <li class="flex items-start mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Waktu pengambilan fleksibel
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Tanpa perlu antri panjang
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Penawaran Terbaru dengan UI yang lebih interaktif -->
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8 animate-on-scroll">
                <span
                    class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium mb-2">Baru
                    Ditambahkan</span>
                <h2 class="text-3xl font-bold mb-4 text-primary-dark">Penawaran Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Selamatkan makanan lezat sekarang sebelum kehabisan. Kami
                    menambahkan penawaran baru setiap hari!</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                <!-- Filter Quick Nav -->
                <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 bg-primary text-white rounded-full text-sm font-medium">Semua</button>
                        <button
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full text-sm font-medium transition">Terdekat</button>
                        <button
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full text-sm font-medium transition">Diskon
                            Tertinggi</button>
                        <button
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full text-sm font-medium transition">Ambil
                            Hari Ini</button>
                    </div>
                    <a href="{{ route('offers.index') }}"
                        class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Lihat Semua
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                @if ($offers->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($offers as $offer)
                            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-white offer-card animate-on-scroll"
                                style="animation-delay: {{ 0.1 * $loop->iteration }}s">
                                <a href="{{ route('offers.show', $offer) }}" class="block">
                                    <!-- Gambar dengan overlay gradient -->
                                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                                        @if ($offer->image)
                                            <img src="{{ $offer->image_url }}" alt="{{ $offer->name }}"
                                                class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                        </div>

                                        <!-- Badge waktu pengambilan -->
                                        <div
                                            class="absolute bottom-3 left-3 bg-white/90 text-primary-dark px-3 py-1 rounded-md text-xs font-medium shadow-sm">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($offer->pickup_start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($offer->pickup_end_time)->format('H:i') }}
                                            </div>
                                        </div>

                                        <!-- Badge stok dan diskon -->
                                        <div class="absolute top-3 right-3 flex flex-col gap-2">
                                            <div
                                                class="bg-primary text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm">
                                                {{ $offer->quantity_remaining }} tersisa
                                            </div>

                                            <div
                                                class="bg-rose-500 text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm discount-badge">
                                                {{ round((($offer->original_price - $offer->discounted_price) / $offer->original_price) * 100) }}%
                                                OFF
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <!-- Info toko dan rating -->
                                        <div class="flex justify-between items-center mb-1">
                                            <div class="text-sm text-gray-500">{{ $offer->store->name }}</div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span class="text-xs font-medium ml-1">4.8</span>
                                            </div>
                                        </div>

                                        <!-- Nama penawaran -->
                                        <h3
                                            class="font-bold text-gray-800 truncate mb-2 group-hover:text-primary transition-colors">
                                            {{ $offer->name }}</h3>

                                        <!-- Harga dan value -->
                                        <div class="flex items-end justify-between">
                                            <div>
                                                <span class="text-xl font-bold text-primary-dark">Rp
                                                    {{ number_format($offer->discounted_price) }}</span>
                                                <div class="flex items-center gap-1 mt-1">
                                                    <span class="text-xs text-gray-500 line-through">Rp
                                                        {{ number_format($offer->original_price) }}</span>
                                                </div>
                                            </div>

                                            <!-- Jarak jika tersedia -->
                                            @if (isset($offer->distance))
                                                <div
                                                    class="flex items-center text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ number_format($offer->distance, 1) }} km
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- State kosong yang lebih menarik -->
                    <div class="text-center py-16 border-2 border-dashed border-gray-200 rounded-lg bg-gray-50">
                        <img src="https://cdn-icons-png.flaticon.com/512/5445/5445197.png" alt="No offers"
                            class="w-24 h-24 mx-auto mb-4 opacity-50">
                        <h3 class="text-lg font-medium text-gray-900">Belum ada penawaran tersedia</h3>
                        <p class="mt-1 text-sm text-gray-500 max-w-md mx-auto">Kami sedang menambahkan penawaran baru.
                            Silakan cek kembali nanti untuk menemukan penawaran makanan menarik dari toko-toko terdekat.
                        </p>
                        <button
                            class="mt-4 px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-md shadow-sm transition">Segarkan
                            Halaman</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Testimoni & Partner Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll">
                <span
                    class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium mb-2">Testimonial</span>
                <h2 class="text-3xl font-bold mb-4 text-primary-dark">Apa Kata Mereka</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ribuan orang telah membantu mengurangi limbah makanan sambil
                    menikmati makanan berkualitas dengan harga terjangkau.</p>
            </div>

            <!-- Testimonials -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition animate-on-scroll"
                    style="animation-delay: 0.2s">
                    <div class="flex items-center mb-4">
                        <div class="bg-gray-200 w-12 h-12 rounded-full overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Heny</h4>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Konsep yang sangat brilian! Saya bisa menghemat uang sambil
                        membantu mengurangi limbah makanan. Makanan yang saya dapatkan selalu berkualitas baik."</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition animate-on-scroll"
                    style="animation-delay: 0.2s">
                    <div class="flex items-center mb-4">
                        <div class="bg-gray-200 w-12 h-12 rounded-full overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Milea</h4>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Konsep yang sangat brilian! Saya bisa menghemat uang sambil
                        membantu mengurangi limbah makanan. Makanan yang saya dapatkan selalu berkualitas baik."</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition animate-on-scroll"
                    style="animation-delay: 0.2s">
                    <div class="flex items-center mb-4">
                        <div class="bg-gray-200 w-12 h-12 rounded-full overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Keyna</h4>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Konsep yang sangat brilian! Saya bisa menghemat uang sambil
                        membantu mengurangi limbah makanan. Makanan yang saya dapatkan selalu berkualitas baik."</p>
                </div>

                <!-- Testimonial 2 & 3 dengan format serupa -->
                <!-- ... -->
            </div>

            <!-- Partner Logos -->
            <div class="animate-on-scroll">
                <h3 class="text-center text-xl font-bold text-gray-800 mb-8">Didukung oleh Mitra Terpercaya</h3>
                <div class="flex flex-wrap justify-center items-center gap-10 opacity-80">
                    <!-- Real food/sustainability themed logos -->

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/9b/UNEP_logo.svg/1200px-UNEP_logo.svg.png"
                        alt="UNEP"
                        class="h-10 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">

                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/UNDP_logo.svg/1011px-UNDP_logo.svg.png"
                        alt="UNDP"
                        class="h-9 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">

                    <img src="https://w7.pngwing.com/pngs/741/278/png-transparent-tokopedia-android-online-shopping-android-shopping-mall-owl-bird-thumbnail.png"
                        alt="Tokopedia"
                        class="h-7 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="relative py-16 bg-gradient-to-r from-primary to-primary-dark overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1581349437898-cebbe9831942?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                alt="Food background" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-3/5 animate-on-scroll">
                    <h2 class="text-3xl font-bold text-white mb-4">Bergabunglah Dengan Komunitas Food Saver</h2>
                    <p class="text-white/90 mb-8 text-lg">
                        Jadilah bagian dari perubahan. Setiap pembelian yang Anda lakukan membantu mengurangi limbah
                        makanan dan mendukung bisnis lokal.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg text-primary-dark bg-white hover:bg-gray-100 shadow-md transition duration-300">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('onboarding.index') }}"
                            class="inline-flex items-center px-6 py-3 border border-white text-base font-bold rounded-lg text-white hover:bg-white/10 transition duration-300">
                            Daftarkan Toko Anda
                        </a>
                    </div>
                </div>
                <div class="hidden md:block md:w-2/5 animate-on-scroll" style="animation-delay: 0.3s">
                    <div class="relative">
                        <div class="absolute -top-16 -right-16 w-32 h-32 bg-white/20 rounded-full"></div>
                        <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-white/20 rounded-full"></div>
                        <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20">
                            <div class="flex items-center justify-center mb-4">
                                <div class="bg-white/20 rounded-full p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center text-white">
                                <p class="text-xl font-bold mb-2">Rata-rata penghematan</p>
                                <p class="text-3xl font-bold mb-4">Rp 35.000 / pesanan</p>
                                <p class="text-sm">Gabung sekarang dan hemat lebih banyak!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Animate on scroll
                const animateElements = document.querySelectorAll('.animate-on-scroll');

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                animateElements.forEach(element => {
                    observer.observe(element);
                });

                // Ambil semua link yang mengarah ke anchor di halaman yang sama
                const anchorLinks = document.querySelectorAll('a[href^="#"]');

                anchorLinks.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return; // Skip jika hanya "#"

                        const targetElement = document.querySelector(targetId);
                        if (!targetElement) return; // Skip jika elemen target tidak ditemukan

                        // Smooth scroll ke elemen target
                        window.scrollTo({
                            top: targetElement.offsetTop - 80, // Offset untuk navbar
                            behavior: 'smooth'
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
