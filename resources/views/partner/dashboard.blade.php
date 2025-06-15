<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mitra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (!$store)
                        {{-- Kondisi 1: Belum mendaftarkan toko --}}
                        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800">Anda belum memiliki toko</h3>
                            <p class="mt-2 text-gray-600 max-w-md mx-auto">Untuk menawarkan produk makanan di Food
                                Saver, Anda perlu mendaftarkan toko Anda terlebih dahulu.</p>
                            <a href="{{ route('partner.stores.create') }}" class="mt-4 inline-block">
                                <x-button variant="primary" size="lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Daftarkan Toko Sekarang
                                </x-button>
                            </a>
                        </div>
                    @elseif ($store->status === 'pending')
                        {{-- Kondisi 2: Toko dalam proses review --}}
                        <div
                            class="text-center py-12 border-2 border-dashed border-primary-light rounded-lg bg-primary-light/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary mx-auto mb-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-primary-dark">Toko Anda Sedang Ditinjau</h3>
                            <p class="mt-2 text-gray-600 max-w-md mx-auto">Terima kasih telah mendaftar. Tim kami akan
                                segera meninjau informasi toko Anda.</p>

                            <!-- Progress indikator -->
                            <div class="max-w-md mx-auto mt-6">
                                <div class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-primary bg-primary-light/30">
                                                Status Verifikasi
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-semibold inline-block text-primary">
                                                Sedang Ditinjau
                                            </span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary-light/30">
                                        <div style="width:50%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary animate-pulse">
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-600 mt-2">
                                        <p>Estimasi waktu verifikasi: 1-2 hari kerja</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($store->status === 'rejected')
                        {{-- Kondisi 3: Toko ditolak --}}
                        <div
                            class="text-center py-12 border-2 border-dashed border-secondary-light rounded-lg bg-secondary-light/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-secondary mx-auto mb-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-secondary">Pendaftaran Toko Ditolak</h3>
                            <p class="mt-2 text-gray-600 max-w-md mx-auto">Mohon maaf, pendaftaran toko Anda belum dapat
                                kami setujui. Silakan periksa kembali informasi Anda atau hubungi support.</p>
                            <a href="{{ route('partner.stores.edit', $store) }}" class="mt-4 inline-block">
                                <x-button variant="secondary">
                                    Edit Informasi Toko
                                </x-button>
                            </a>
                        </div>
                    @elseif ($store->status === 'approved')
                        {{-- Kondisi 4: Toko sudah disetujui --}}
                        <div class="text-center py-8 bg-primary-light/10 rounded-lg mb-8">
                            <h3 class="text-xl font-bold text-primary-dark">Selamat Datang, {{ $store->name }}!</h3>
                            <p class="mt-2 text-gray-600">Toko Anda sudah aktif. Sekarang Anda bisa mulai mengelola
                                penawaran produk Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                            <a href="{{ route('partner.offers.index') }}"
                                class="block p-6 bg-white border border-primary-light/40 rounded-lg shadow-sm hover:shadow-md transition">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-primary-light/30 p-3 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Kelola Penawaran</h3>
                                        <p class="text-sm text-gray-600">Atur produk yang ditawarkan</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('partner.order.confirm.index') }}"
                                class="block p-6 bg-white border border-primary-light/40 rounded-lg shadow-sm hover:shadow-md transition">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-primary-light/30 p-3 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Konfirmasi Pesanan</h3>
                                        <p class="text-sm text-gray-600">Verifikasi pengambilan pesanan</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('partner.stores.edit', $store) }}"
                                class="block p-6 bg-white border border-primary-light/40 rounded-lg shadow-sm hover:shadow-md transition">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-primary-light/30 p-3 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Edit Toko</h3>
                                        <p class="text-sm text-gray-600">Perbarui informasi toko</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
