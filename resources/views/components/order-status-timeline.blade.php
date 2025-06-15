@props(['status', 'order'])

<div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
    <h3 class="text-lg font-semibold text-gray-800 mb-3">Status Pesanan</h3>

    <div class="relative">
        <!-- Timeline Track -->
        <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

        <!-- Timeline Steps -->
        <div class="space-y-6">
            <!-- Step 1: Pesanan Dibuat -->
            <div class="relative flex items-start">
                <div
                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full {{ $status != 'canceled' ? 'bg-primary' : 'bg-gray-300' }} text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Pesanan Dibuat</h4>
                    <p class="text-xs text-gray-500">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                    <p class="text-xs text-gray-600 mt-0.5">Pesanan telah dibuat dan menunggu pembayaran</p>
                </div>
            </div>

            <!-- Step 2: Pembayaran -->
            <div class="relative flex items-start">
                <div
                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full 
                    {{ in_array($status, ['paid', 'completed']) ? 'bg-primary' : (in_array($status, ['pending_payment']) ? 'bg-amber-500 animate-pulse' : 'bg-gray-300') }} text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Pembayaran</h4>
                    @if ($status == 'pending_payment')
                        <p class="text-xs text-amber-600 font-medium">Menunggu pembayaran</p>
                        <p class="text-xs text-gray-600 mt-0.5">Silakan selesaikan pembayaran Anda</p>
                    @elseif(in_array($status, ['paid', 'completed']))
                        <p class="text-xs text-gray-500">
                            {{ $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->translatedFormat('d M Y, H:i') : 'Tidak diketahui' }}
                        </p>
                        <p class="text-xs text-gray-600 mt-0.5">Pembayaran telah berhasil diverifikasi</p>
                    @else
                        <p class="text-xs text-gray-500">-</p>
                        <p class="text-xs text-gray-600 mt-0.5">Menunggu pembayaran</p>
                    @endif
                </div>
            </div>

            <!-- Step 3: Siap Diambil -->
            <div class="relative flex items-start">
                <div
                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full 
                    {{ $status == 'paid' ? 'bg-blue-500 animate-pulse' : ($status == 'completed' ? 'bg-primary' : 'bg-gray-300') }} text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Siap Diambil</h4>
                    @if ($status == 'paid')
                        <p class="text-xs text-blue-600 font-medium">Pesanan siap diambil</p>
                        <p class="text-xs text-gray-600 mt-0.5">
                            Jadwal pengambilan:
                            {{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->translatedFormat('d M Y, H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($order->offer->pickup_end_time)->translatedFormat('H:i') }}
                        </p>
                    @elseif($status == 'completed')
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($order->offer->pickup_start_time)->translatedFormat('d M Y, H:i') }}
                        </p>
                        <p class="text-xs text-gray-600 mt-0.5">Pesanan telah siap untuk diambil</p>
                    @else
                        <p class="text-xs text-gray-500">-</p>
                        <p class="text-xs text-gray-600 mt-0.5">Menunggu konfirmasi pembayaran</p>
                    @endif
                </div>
            </div>

            <!-- Step 4: Pengambilan Selesai -->
            <div class="relative flex items-start">
                <div
                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full 
                    {{ $status == 'completed' ? 'bg-primary' : 'bg-gray-300' }} text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Pengambilan Selesai</h4>
                    @if ($status == 'completed')
                        <p class="text-xs text-gray-500">
                            {{ $order->picked_up_at ? \Carbon\Carbon::parse($order->picked_up_at)->translatedFormat('d M Y, H:i') : 'Tidak diketahui' }}
                        </p>
                        <p class="text-xs text-gray-600 mt-0.5">Pesanan telah berhasil diambil</p>
                    @else
                        <p class="text-xs text-gray-500">-</p>
                        <p class="text-xs text-gray-600 mt-0.5">Menunggu pengambilan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
