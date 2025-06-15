<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Berhasil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="p-6 md:p-10">
                    <svg class="w-20 h-20 mx-auto mb-4 text-green-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <h1 class="text-2xl md:text-3xl font-bold mb-2 text-primary-dark">Pembayaran Berhasil!</h1>
                    <p class="text-gray-600 mb-6">Pesanan Anda telah dikonfirmasi.</p>

                    <div class="bg-gray-100 p-4 rounded-lg inline-block mb-6">
                        <p class="text-sm text-gray-700">Kode Pesanan Anda:</p>
                        <p class="font-mono text-2xl md:text-3xl font-bold text-primary-dark tracking-wider">
                            {{ $order->order_code }}</p>
                    </div>

                    <p class="text-sm text-gray-600 mb-6">
                        Tunjukkan kode ini kepada mitra saat pengambilan pesanan.
                    </p>

                    <!-- Timeline Status Pesanan -->
                    <div class="text-left mb-8">
                        <x-order-status-timeline :status="$order->status" :order="$order" />
                    </div>

                    <div class="border-t border-gray-200 pt-6 mb-6 text-left">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Detail Pesanan:</h3>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Produk:</span>
                            <span class="font-medium">{{ $order->offer->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Toko:</span>
                            <span class="font-medium">{{ $order->offer->store->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Alamat Toko:</span>
                            <span class="font-medium text-right">{{ $order->offer->store->address }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Jadwal Pengambilan:</span>
                            <span class="font-medium text-right">
                                {{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->translatedFormat('d M Y, H:i') }}
                                - {{ \Carbon\Carbon::parse($order->offer->pickup_end_time)->translatedFormat('H:i') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-lg font-bold mt-2 pt-2 border-t border-gray-100">
                            <span>Total Bayar:</span>
                            <span>Rp {{ number_format($order->total_price) }}</span>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-md transition duration-300">
                            Lihat Pesanan Saya
                        </a>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($order->offer->store->latitude . ',' . $order->offer->store->longitude) }}"
                            target="_blank"
                            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lihat Lokasi Toko
                        </a>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="text-primary hover:text-primary-dark text-sm">
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Tambahkan ke Kalender (opsional) -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-sm text-gray-600 mb-2">Tambahkan jadwal pengambilan ke kalender Anda:</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-blue-600 hover:text-blue-800" id="add-to-calendar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tambahkan ke Kalender
                document.getElementById('add-to-calendar').addEventListener('click', function(e) {
                    e.preventDefault();

                    // Format tanggal untuk kalender
                    const startTime =
                        "{{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->format('Y-m-d\TH:i:s') }}";
                    const endTime =
                        "{{ \Carbon\Carbon::parse($order->offer->pickup_end_time)->format('Y-m-d\TH:i:s') }}";
                    const title = "Pengambilan Pesanan Food Saver - {{ $order->order_code }}";
                    const location = "{{ $order->offer->store->address }}";
                    const details =
                        "Pengambilan pesanan {{ $order->offer->name }} dari {{ $order->offer->store->name }}. Kode pesanan: {{ $order->order_code }}";

                    // Generate Google Calendar URL
                    const googleUrl =
                        `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${startTime.replace(/[-:]/g, '')}/${endTime.replace(/[-:]/g, '')}&details=${encodeURIComponent(details)}&location=${encodeURIComponent(location)}&sprop=&sprop=name:`;

                    window.open(googleUrl, '_blank');
                });

                // Tampilkan notifikasi pengingat
                if (typeof showNotification === 'function') {
                    showNotification('Jangan lupa untuk mengambil pesanan Anda sesuai jadwal!', 'info');

                    // Set alarm lokal untuk pengingat pengambilan
                    const pickupTime = new Date(
                        "{{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->format('Y-m-d H:i:s') }}");
                    const now = new Date();
                    const timeUntilPickup = pickupTime - now;

                    // Jika waktu pengambilan belum lewat dan kurang dari 24 jam
                    if (timeUntilPickup > 0 && timeUntilPickup < 24 * 60 * 60 * 1000) {
                        // Set reminder 1 jam sebelum pengambilan
                        const reminderTime = timeUntilPickup - (60 * 60 * 1000);
                        if (reminderTime > 0) {
                            setTimeout(() => {
                                showNotification('Pengingat: Pesanan Anda siap diambil dalam 1 jam!',
                                'warning');
                            }, reminderTime);
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
