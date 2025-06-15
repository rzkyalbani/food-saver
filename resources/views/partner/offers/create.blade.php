<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penawaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                            <strong class="font-bold">Oops! Ada yang salah:</strong>
                            <ul class="mt-1 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('partner.offers.store') }}">
                        @csrf
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Penawaran</label>
                            <x-text-input id="name" name="name" type="text"
                                placeholder="Contoh: Surprise Box Roti & Kue" class="mt-1 block w-full"
                                value="{{ old('name') }}" required />
                            <p class="mt-1 text-xs text-gray-500">Nama yang menarik akan lebih memikat pelanggan.</p>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Gambar
                                Penawaran</label>
                            <input id="image" name="image" type="file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-md file:border-0
        file:text-sm file:font-semibold
        file:bg-primary file:text-white
        hover:file:bg-primary-dark" />
                            <p class="mt-1 text-xs text-gray-500">Upload gambar menarik dari penawaran Anda (maks. 2MB).
                                Format JPG, PNG, atau WebP.</p>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi
                                Penawaran</label>
                            <x-textarea id="description" name="description"
                                placeholder="Jelaskan isi penawaran, misal: Berisi aneka roti manis, kue basah, dan donat sisa hari ini yang masih layak konsumsi."
                                class="mt-1 block w-full" rows="3">{{ old('description') }}</x-textarea>
                            <p class="mt-1 text-xs text-gray-500">Deskripsi singkat tentang apa yang akan didapatkan
                                pelanggan (opsional).</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="original_price" class="block font-medium text-sm text-gray-700">Harga Asli
                                    (Rp)</label>
                                <x-text-input id="original_price" name="original_price" type="number"
                                    placeholder="Misal: 100000" class="mt-1 block w-full"
                                    value="{{ old('original_price') }}" required />
                            </div>
                            <div>
                                <label for="discounted_price" class="block font-medium text-sm text-gray-700">Harga
                                    Diskon (Rp)</label>
                                <x-text-input id="discounted_price" name="discounted_price" type="number"
                                    placeholder="Misal: 35000" class="mt-1 block w-full"
                                    value="{{ old('discounted_price') }}" required />
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Harga diskon harus lebih rendah dari harga asli.</p>


                        <div class="mt-4">
                            <label for="quantity_initial" class="block font-medium text-sm text-gray-700">Jumlah Stok
                                Tersedia</label>
                            <x-text-input id="quantity_initial" name="quantity_initial" type="number"
                                class="mt-1 block w-full" value="{{ old('quantity_initial', 1) }}" min="1"
                                required />
                            <p class="mt-1 text-xs text-gray-500">Jumlah paket/item yang Anda tawarkan.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="pickup_start_time" class="block font-medium text-sm text-gray-700">Jadwal
                                    Ambil (Mulai)</label>
                                <x-text-input id="pickup_start_time" name="pickup_start_time" type="datetime-local"
                                    class="mt-1 block w-full" value="{{ old('pickup_start_time') }}" required />
                            </div>
                            <div>
                                <label for="pickup_end_time" class="block font-medium text-sm text-gray-700">Jadwal
                                    Ambil (Selesai)</label>
                                <x-text-input id="pickup_end_time" name="pickup_end_time" type="datetime-local"
                                    class="mt-1 block w-full" value="{{ old('pickup_end_time') }}" required />
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Rentang waktu pelanggan dapat mengambil pesanan.</p>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('partner.offers.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <x-button variant="primary" size="lg">
                                Simpan Penawaran
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
