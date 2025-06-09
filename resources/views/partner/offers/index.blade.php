<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Penawaran Anda') }}
            </h2>
            <a href="{{ route('partner.offers.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark-green focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Buat Penawaran Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-gray uppercase tracking-wider">
                                        Nama Penawaran
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-gray uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-gray uppercase tracking-wider">
                                        Kuantitas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-gray uppercase tracking-wider">
                                        Jadwal Pengambilan
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($offers as $offer)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-text-dark">{{ $offer->name }}</div>
                                            <div class="text-sm text-text-gray">{{ $offer->category->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-text-dark">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</div>
                                            <div class="text-sm text-text-gray line-through">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-medium text-text-dark">{{ $offer->quantity }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-gray">
                                            {{ \Carbon\Carbon::parse($offer->pickup_start_time)->format('d M, H:i') }} - {{ \Carbon\Carbon::parse($offer->pickup_end_time)->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <span class="text-gray-300 mx-1">|</span>
                                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-text-gray">
                                            Anda belum memiliki penawaran. <a href="{{ route('partner.offers.create') }}" class="text-primary-green hover:underline font-semibold">Buat satu sekarang!</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>