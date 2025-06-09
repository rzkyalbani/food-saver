<x-guest-layout>
    <div class="bg-bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-text-dark text-center">Selamatkan Makanan Lezat di Sekitarmu</h1>
            <p class="mt-4 text-center text-text-gray max-w-2xl mx-auto">Temukan penawaran terbaik dari restoran dan toko favoritmu dengan harga super hemat.</p>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($offers as $offer)
                    <x-offer-card :offer="$offer" />
                @empty
                    <p class="col-span-3 text-center text-text-gray">Yah, belum ada penawaran tersedia saat ini. Cek lagi nanti ya!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>