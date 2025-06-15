<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Informasi Toko Anda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6" style="color: #3D5A47;">Detail Toko: {{ $store->name }}</h3>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative" role="alert">
                            <strong class="font-bold">Oops! Ada yang salah:</strong>
                            <ul class="mt-1 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                     @if (session('status'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('partner.stores.update', $store) }}">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Toko</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" value="{{ old('name', $store->name) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi Toko</label>
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" rows="3" required>{{ old('description', $store->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="address" class="block font-medium text-sm text-gray-700">Alamat Lengkap Toko</label>
                            <textarea id="address" name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" rows="2" required>{{ old('address', $store->address) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="phone_number" class="block font-medium text-sm text-gray-700">Nomor Telepon Toko</label>
                            <input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" value="{{ old('phone_number', $store->phone_number) }}" required />
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Lokasi Toko di Peta</label>
                            <div id="map" style="height: 350px; border-radius: 0.375rem;" class="border border-gray-300 rounded-md"></div>
                            <p class="mt-1 text-xs text-gray-500">Geser pin pada peta atau gunakan tombol di bawah untuk menentukan lokasi toko Anda.</p>
                            <button type="button" id="findMyLocation" class="mt-2 text-sm text-amber-600 hover:text-amber-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                Temukan Lokasi Saya Saat Ini
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
                            <div>
                                <label for="latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm bg-gray-50" value="{{ old('latitude', $store->latitude) }}" readonly required />
                            </div>
                            <div>
                                <label for="longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
                                <input id="longitude" name="longitude" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm bg-gray-50" value="{{ old('longitude', $store->longitude) }}" readonly required />
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Perubahan pada informasi toko akan memerlukan peninjauan ulang oleh Admin.</p>

                        <div class="flex items-center justify-end mt-8">
                             <a href="{{ route('partner.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 text-white font-semibold rounded-lg shadow-md transition duration-300" style="background-color: #4A7C59; hover:background-color: #3D5A47;">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- Pastikan Leaflet CSS dan JS sudah di-include di app.blade.php --}}
    <script>
        const initialLatitude = {{ old('latitude', $store->latitude) }};
        const initialLongitude = {{ old('longitude', $store->longitude) }};
        const map = L.map('map').setView([initialLatitude, initialLongitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([initialLatitude, initialLongitude], { draggable: true }).addTo(map);

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        marker.on('dragend', function(e) {
            const newPosition = marker.getLatLng();
            latitudeInput.value = newPosition.lat.toFixed(6);
            longitudeInput.value = newPosition.lng.toFixed(6);
        });

        document.getElementById('findMyLocation').addEventListener('click', function() {
            const button = this;
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin h-4 w-4 mr-1 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mencari lokasi...';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        latitudeInput.value = lat.toFixed(6);
                        longitudeInput.value = lng.toFixed(6);
                        marker.setLatLng([lat, lng]);
                        map.setView([lat, lng], 16);
                        
                        button.disabled = false;
                        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>Temukan Lokasi Saya Saat Ini';
                    },
                    function(error) {
                        alert('Gagal mendapatkan lokasi: ' + error.message);
                        button.disabled = false;
                        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>Temukan Lokasi Saya Saat Ini';
                    }
                );
            } else {
                alert('Browser Anda tidak mendukung geolokasi.');
                button.disabled = false;
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>Temukan Lokasi Saya Saat Ini';
            }
        });
    </script>
    @endpush
</x-app-layout>