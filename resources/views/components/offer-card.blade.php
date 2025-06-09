@props(['offer'])

<div class="bg-white rounded-lg shadow-sm overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
    <a href="{{ route('offers.show', $offer) }}">
        {{-- Ganti dengan gambar jika ada, untuk sekarang pakai background saja --}}
        <div class="bg-gray-200 h-40 flex items-center justify-center">
            <span class="text-gray-400">Gambar Segera</span>
        </div>
        <div class="p-4">
            <p class="text-xs text-text-gray">{{ $offer->partner->store_name }}</p>
            <h3 class="font-bold text-lg text-text-dark mt-1 truncate">{{ $offer->name }}</h3>
            <p class="text-sm text-text-gray mt-2">Ambil: {{ \Carbon\Carbon::parse($offer->pickup_start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($offer->pickup_end_time)->format('H:i') }}</p>

            <div class="mt-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-text-gray line-through">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</p>
                    <p class="text-xl font-extrabold text-primary-green">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</p>
                </div>
                <span class="text-xs font-semibold bg-accent-yellow/20 text-accent-yellow px-2 py-1 rounded-full">{{ $offer->quantity }} Tersisa</span>
            </div>
        </div>
    </a>
</div>