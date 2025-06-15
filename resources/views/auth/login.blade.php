<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Food Saver') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:flex-row items-center justify-center">
        <!-- Left Panel - Branding Side -->
        <div
            class="hidden sm:block sm:w-1/2 h-screen bg-gradient-to-br from-primary to-primary-dark relative overflow-hidden">
            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10">
                <svg width="100%" height="100%">
                    <pattern id="pattern-circles" x="0" y="0" width="40" height="40"
                        patternUnits="userSpaceOnUse" patternContentUnits="userSpaceOnUse">
                        <circle id="pattern-circle" cx="20" cy="20" r="10" fill="none" stroke="white"
                            stroke-width="1"></circle>
                    </pattern>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-circles)"></rect>
                </svg>
            </div>

            <!-- Main content -->
            <div class="flex flex-col justify-center items-center h-full text-white px-10 relative z-10">
                <div class="max-w-md">
                    <!-- Logo and branding -->
                    <div class="flex items-center mb-8">
                        <div class="bg-white/20 p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h1 class="text-4xl font-bold">Food Saver</h1>
                    </div>

                    <!-- Tagline -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold mb-2">Selamatkan Makanan, Hemat Uang</h2>
                        <p class="text-xl mb-8 text-white/90">Bergabunglah dengan komunitas yang peduli dengan
                            pengurangan limbah makanan.</p>
                    </div>

                    <!-- Benefits with improved visual -->
                    <div class="space-y-6">
                        <div
                            class="flex items-center bg-white/10 p-4 rounded-xl backdrop-blur-sm transform transition hover:scale-105">
                            <div class="bg-white/20 p-3 rounded-full mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p>Diskon hingga 70% untuk makanan berkualitas dari toko dan restoran lokal</p>
                        </div>

                        <div
                            class="flex items-center bg-white/10 p-4 rounded-xl backdrop-blur-sm transform transition hover:scale-105">
                            <div class="bg-white/20 p-3 rounded-full mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <p>Proses pemesanan yang cepat dan mudah melalui aplikasi</p>
                        </div>

                        <div
                            class="flex items-center bg-white/10 p-4 rounded-xl backdrop-blur-sm transform transition hover:scale-105">
                            <div class="bg-white/20 p-3 rounded-full mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <p>Berkontribusi pada lingkungan dengan mengurangi limbah makanan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative elements -->
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-primary-dark to-transparent"></div>
            <div class="absolute bottom-10 right-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40 text-white opacity-5" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd"
                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full sm:w-1/2 px-6 py-8 sm:py-0 flex items-center justify-center">
            <div class="w-full max-w-md">
                <div class="text-center sm:hidden mb-8">
                    <h1 class="text-3xl font-bold text-primary-dark">Food Saver</h1>
                    <p class="text-sm text-gray-600 mt-1">Selamatkan makanan, hemat uang</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                        <p class="text-gray-600 mt-1">Masuk untuk melanjutkan perjalanan Anda</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email"
                                    name="email" :value="old('email')" required autofocus autocomplete="username"
                                    placeholder="email@example.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-xs text-primary hover:text-primary-dark"
                                        href="{{ route('password.request') }}">
                                        {{ __('Lupa password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input id="password" class="block mt-1 w-full pl-10" type="password"
                                    name="password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mb-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center items-center px-4 py-2 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-sm transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ __('Masuk') }}
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="text-primary hover:text-primary-dark font-medium">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}"
                        class="text-sm text-gray-600 hover:text-primary inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
