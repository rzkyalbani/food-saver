<x-guest-layout>
    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-4xl font-bold">{{ $offer->name }}</h1>
        <p>disediakan oleh {{ $offer->partner->store_name }}</p>
        <div class="mt-8 p-6 border border-border-light rounded-lg">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                <input type="hidden" name="quantity" value="1"> {{-- Untuk saat ini, kita hardcode kuantitas 1 --}}

                <div class="flex justify-between items-center">
                    <p class="text-2xl font-bold text-primary-green">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</p>
                    <button type="submit" class="px-6 py-3 bg-primary-green text-white font-bold rounded-lg hover:bg-dark-green">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>