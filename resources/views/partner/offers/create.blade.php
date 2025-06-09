<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Penawaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('partner.offers.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-text-gray">Nama Penawaran</label>
                            <input type="text" name="name" id="name" placeholder="Contoh: Surprise Bag - Roti & Kue" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                        </div>

                        <div>
                             <label for="category_id" class="block text-sm font-medium text-text-gray">Kategori</label>
                             <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                                 <option disabled selected>Pilih Kategori</option>
                                 {{-- @foreach($categories as $category)
                                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                                 @endforeach --}}
                                 <option value="1">Roti & Kue</option>
                                 <option value="2">Makanan Utama</option>
                             </select>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-text-gray">Deskripsi Singkat</label>
                            <textarea name="description" id="description" rows="3" placeholder="Jelaskan kira-kira apa saja isi dari Surprise Bag Anda. Contoh: Berisi campuran roti manis, kue potong, dan donat sisa dari hari ini." class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="original_price" class="block text-sm font-medium text-text-gray">Harga Asli (Rp)</label>
                                <input type="number" name="original_price" id="original_price" placeholder="50000" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                            </div>
                            <div>
                                <label for="discounted_price" class="block text-sm font-medium text-text-gray">Harga Jual / Diskon (Rp)</label>
                                <input type="number" name="discounted_price" id="discounted_price" placeholder="25000" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                            </div>
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-text-gray">Kuantitas Tersedia</label>
                            <input type="number" name="quantity" id="quantity" placeholder="10" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                <label for="pickup_start_time" class="block text-sm font-medium text-text-gray">Waktu Mulai Pengambilan</label>
                                <input type="datetime-local" name="pickup_start_time" id="pickup_start_time" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                            </div>
                             <div>
                                <label for="pickup_end_time" class="block text-sm font-medium text-text-gray">Waktu Selesai Pengambilan</label>
                                <input type="datetime-local" name="pickup_end_time" id="pickup_end_time" class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:ring-primary-green focus:border-primary-green">
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end pt-4 border-t border-border-light">
                            <a href="{{ route('partner.offers.index') }}" class="text-sm text-text-gray hover:underline mr-4">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark-green focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan Penawaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>