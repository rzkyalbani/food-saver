<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Penawaran') }}
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

                    <form method="POST" enctype="multipart/form-data" action="{{ route('partner.offers.update', $offer) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Penawaran</label>
                            <x-text-input id="name" name="name" type="text"
                                placeholder="Contoh: Surprise Box Roti & Kue" class="mt-1 block w-full"
                                value="{{ old('name', $offer->name) }}" required />
                            <p class="mt-1 text-xs text-gray-500">Nama yang menarik akan lebih memikat pelanggan.</p>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Gambar
                                Penawaran</label>

                            @if ($offer->image)
                                <div class="mt-2 mb-3">
                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->name }}"
                                        class="h-40 w-auto object-cover rounded-lg border">
                                    <div class="mt-1 text-xs text-gray-500">Gambar saat ini. Upload gambar baru untuk
                                        menggantinya.</div>
                                </div>
                            @endif

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
                                class="mt-1 block w-full" rows="3">{{ old('description', $offer->description) }}
                            </x-textarea>
                            <p class="mt-1 text-xs text-gray-500">Deskripsi singkat tentang apa yang akan didapatkan
                                pelanggan (opsional).</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="original_price" class="block font-medium text-sm text-gray-700">Harga Asli
                                    (Rp)</label>
                                <x-text-input id="original_price" name="original_price" type="number"
                                    placeholder="Misal: 100000" class="mt-1 block w-full"
                                    value="{{ old('original_price', $offer->original_price) }}" required />
                            </div>
                            <div>
                                <label for="discounted_price" class="block font-medium text-sm text-gray-700">Harga
                                    Diskon (Rp)</label>
                                <x-text-input id="discounted_price" name="discounted_price" type="number"
                                    placeholder="Misal: 35000" class="mt-1 block w-full"
                                    value="{{ old('discounted_price', $offer->discounted_price) }}" required />
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Harga diskon harus lebih rendah dari harga asli.</p>

                        <div class="mt-4">
                            <label for="quantity_initial" class="block font-medium text-sm text-gray-700">Jumlah Stok
                                Awal</label>
                            <x-text-input id="quantity_initial" name="quantity_initial" type="number"
                                class="mt-1 block w-full"
                                value="{{ old('quantity_initial', $offer->quantity_initial) }}" min="1"
                                required />
                            <p class="mt-1 text-xs text-gray-500">Jumlah paket/item yang Anda tawarkan.</p>
                        </div>

                        <div class="mt-4 bg-gray-50 p-3 rounded-md">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Sisa stok saat ini: <strong>{{ $offer->quantity_remaining }}</strong> dari
                                    {{ $offer->quantity_initial }} total</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="pickup_start_time" class="block font-medium text-sm text-gray-700">Jadwal
                                    Ambil (Mulai)</label>
                                <x-text-input id="pickup_start_time" name="pickup_start_time" type="datetime-local"
                                    class="mt-1 block w-full"
                                    value="{{ old('pickup_start_time', date('Y-m-d\TH:i', strtotime($offer->pickup_start_time))) }}"
                                    required />
                            </div>
                            <div>
                                <label for="pickup_end_time" class="block font-medium text-sm text-gray-700">Jadwal
                                    Ambil (Selesai)</label>
                                <x-text-input id="pickup_end_time" name="pickup_end_time" type="datetime-local"
                                    class="mt-1 block w-full"
                                    value="{{ old('pickup_end_time', date('Y-m-d\TH:i', strtotime($offer->pickup_end_time))) }}"
                                    required />
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Rentang waktu pelanggan dapat mengambil pesanan.</p>

                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status
                                Penawaran</label>
                            <x-select id="status" name="status" class="mt-1 block w-full">
                                <option value="active"
                                    {{ old('status', $offer->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive"
                                    {{ old('status', $offer->status) == 'inactive' ? 'selected' : '' }}>Nonaktif
                                </option>
                                <option value="sold_out"
                                    {{ old('status', $offer->status) == 'sold_out' ? 'selected' : '' }}>Habis Terjual
                                </option>
                            </x-select>
                            <p class="mt-1 text-xs text-gray-500">Penawaran dengan status nonaktif atau habis terjual
                                tidak akan ditampilkan.</p>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('partner.offers.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <x-button variant="primary" size="lg">
                                Simpan Perubahan
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
