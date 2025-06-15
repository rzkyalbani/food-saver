<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6 text-primary-dark">Pesanan Saya</h3>

                    @if ($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach ($orders as $order)
                                <div
                                    class="border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow transition-shadow duration-300">
                                    <div class="flex flex-col md:flex-row">
                                        <!-- Placeholder gambar penawaran -->
                                        <div class="w-full md:w-1/4 bg-gray-200 h-48 md:h-auto relative">
                                            <!-- Badge status pesanan -->
                                            <div
                                                class="absolute top-3 right-3 
                                                @if ($order->status == 'paid') bg-blue-500 
                                                @elseif($order->status == 'completed') bg-primary 
                                                @elseif($order->status == 'pending_payment') bg-amber-500 
                                                @else bg-gray-500 @endif 
                                                text-white px-3 py-1 rounded-full text-sm font-medium">
                                                @if ($order->status == 'paid')
                                                    Siap Diambil
                                                @elseif($order->status == 'completed')
                                                    Selesai
                                                @elseif($order->status == 'pending_payment')
                                                    Menunggu Pembayaran
                                                @else
                                                    {{ ucfirst($order->status) }}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="p-6 md:p-8 w-full md:w-3/4 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <h3 class="text-lg font-bold text-gray-800">
                                                        {{ $order->offer->name }}</h3>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $order->created_at->format('d M Y, H:i') }}</p>
                                                </div>

                                                <p class="text-sm text-gray-600 mb-4">{{ $order->offer->store->name }}
                                                </p>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <p class="text-xs text-gray-500">Harga</p>
                                                        <p class="font-semibold text-primary-dark">Rp
                                                            {{ number_format($order->total_price) }}</p>
                                                    </div>

                                                    <div>
                                                        <p class="text-xs text-gray-500">Kode Pesanan</p>
                                                        <p class="font-mono font-semibold">{{ $order->order_code }}</p>
                                                    </div>

                                                    <div>
                                                        <p class="text-xs text-gray-500">Jadwal Ambil</p>
                                                        <p class="text-sm">
                                                            {{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->format('d M Y, H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($order->offer->pickup_end_time)->format('H:i') }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <p class="text-xs text-gray-500">Alamat Pengambilan</p>
                                                        <p class="text-sm">{{ $order->offer->store->address }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order Timeline (Collapsed by default, expandable) -->
                                            <div class="mt-4 mb-2">
                                                <button type="button"
                                                    class="text-sm text-primary flex items-center focus:outline-none toggle-timeline"
                                                    data-target="timeline-{{ $order->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 mr-1 toggle-icon" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>Lihat Status Pesanan</span>
                                                </button>

                                                <div id="timeline-{{ $order->id }}" class="hidden mt-3">
                                                    <x-order-status-timeline :status="$order->status" :order="$order" />
                                                </div>
                                            </div>

                                            <div
                                                class="pt-4 border-t border-gray-100 flex flex-wrap justify-between items-center">
                                                @if ($order->status == 'pending_payment')
                                                    <div class="w-full sm:w-auto mb-2 sm:mb-0">
                                                        <div class="text-xs text-secondary flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Segera lakukan pembayaran sebelum batas waktu habis.
                                                        </div>
                                                    </div>
                                                    <a href="{{ $order->payment_url }}" target="_blank">
                                                        <x-button variant="primary">Bayar Sekarang</x-button>
                                                    </a>
                                                @elseif($order->status == 'paid')
                                                    <div class="w-full sm:w-auto mb-2 sm:mb-0">
                                                        <div class="text-xs text-gray-600">
                                                            Tunjukkan kode pesanan saat pengambilan.
                                                        </div>
                                                    </div>
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($order->offer->store->latitude . ',' . $order->offer->store->longitude) }}"
                                                        target="_blank"
                                                        class="px-4 py-2 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-sm flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Lihat Lokasi
                                                    </a>
                                                @elseif($order->status == 'completed')
                                                    <div class="w-full sm:w-auto">
                                                        <div class="text-xs text-gray-600 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4 mr-1 text-primary" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Pesanan diambil pada:
                                                            {{ $order->picked_up_at ? \Carbon\Carbon::parse($order->picked_up_at)->format('d M Y, H:i') : 'Tidak diketahui' }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-full sm:w-auto">
                                                        <div class="text-xs text-gray-600">
                                                            Status: {{ ucfirst($order->status) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Anda belum memiliki pesanan.</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai cari penawaran menarik sekarang!</p>
                            <div class="mt-6">
                                <a href="{{ route('offers.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                    Cari Penawaran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Timeline toggle
                const toggleButtons = document.querySelectorAll('.toggle-timeline');
                toggleButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetId = this.dataset.target;
                        const targetElement = document.getElementById(targetId);
                        const iconElement = this.querySelector('.toggle-icon');

                        if (targetElement.classList.contains('hidden')) {
                            targetElement.classList.remove('hidden');
                            iconElement.style.transform = 'rotate(180deg)';
                            this.querySelector('span').textContent = 'Sembunyikan Status Pesanan';
                        } else {
                            targetElement.classList.add('hidden');
                            iconElement.style.transform = 'rotate(0)';
                            this.querySelector('span').textContent = 'Lihat Status Pesanan';
                        }
                    });
                });

                // Cek apakah ada pesanan yang siap diambil dan belum dinotifikasi
                const readyOrders = document.querySelectorAll('[data-status="paid"]');
                if (readyOrders.length > 0 && typeof showNotification === 'function') {
                    showNotification('Anda memiliki ' + readyOrders.length + ' pesanan yang siap diambil.', 'info');
                }
            });

            document.addEventListener('click', function(event) {
                if (event.target.closest('.toggle-timeline')) {
                    const button = event.target.closest('.toggle-timeline');
                    const targetId = button.dataset.target;
                    const targetElement = document.getElementById(targetId);
                    const iconElement = button.querySelector('.toggle-icon');

                    if (targetElement.classList.contains('hidden')) {
                        targetElement.classList.remove('hidden');
                        iconElement.style.transform = 'rotate(180deg)';
                        button.querySelector('span').textContent = 'Sembunyikan Status Pesanan';
                    } else {
                        targetElement.classList.add('hidden');
                        iconElement.style.transform = 'rotate(0)';
                        button.querySelector('span').textContent = 'Lihat Status Pesanan';
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
