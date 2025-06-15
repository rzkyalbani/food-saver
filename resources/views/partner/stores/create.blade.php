<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftarkan Toko Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-6">Data Toko</h3>
                    
                    <form method="POST" action="{{ route('partner.stores.store') }}">
                        @csrf
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Toko</label>
                            <input id="name" name="name" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('name') }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" rows="3" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="address" class="block font-medium text-sm text-gray-700">Alamat Lengkap</label>
                            <textarea id="address" name="address" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" rows="2" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="phone_number" class="block font-medium text-sm text-gray-700">Nomor Telepon</label>
                            <input id="phone_number" name="phone_number" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('phone_number') }}" required />
                        </div>

                        {{-- Tambahkan Peta untuk memilih lokasi --}}
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Pilih Lokasi Toko di Peta</label>
                            <div id="map" style="height: 400px; border-radius: 0.375rem;" class="border border-gray-300"></div>
                            <p class="mt-1 text-sm text-gray-500">Geser pin pada peta untuk menentukan lokasi toko Anda dengan tepat, atau gunakan tombol "Temukan Lokasi Saya" untuk menggunakan lokasi saat ini.</p>
                            <button type="button" id="findMyLocation" class="mt-2 px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm rounded-md">
                                <i class="fas fa-location-arrow mr-1"></i> Temukan Lokasi Saya
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="block mt-1 w-full bg-gray-100 rounded-md shadow-sm border-gray-300" readonly required />
                            </div>
                            <div>
                                <label for="longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
                                <input id="longitude" name="longitude" type="text" class="block mt-1 w-full bg-gray-100 rounded-md shadow-sm border-gray-300" readonly required />
                            </div>
                        </div>

                        {{-- ============================================================= --}}

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600 transition">
                                Daftarkan Toko
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Menambahkan script Leaflet ke dalam stack 'scripts' --}}
    @push('scripts')
    <script>
        // Koordinat default (misal: Tugu Muda Semarang)
        const defaultLatitude = -6.9928;
        const defaultLongitude = 110.4207;

        // Inisialisasi Peta
        const map = L.map('map').setView([defaultLatitude, defaultLongitude], 14);

        // Menambahkan Tile Layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Menambahkan Marker yang bisa digeser
        let marker = L.marker([defaultLatitude, defaultLongitude], {
            draggable: true
        }).addTo(map);

        // Mengambil elemen input
        const latitudeInput = document.querySelector('#latitude');
        const longitudeInput = document.querySelector('#longitude');

        // Mengisi nilai awal input
        latitudeInput.value = marker.getLatLng().lat;
        longitudeInput.value = marker.getLatLng().lng;

        // Event listener saat marker digeser
        marker.on('dragend', function(e) {
            const newPosition = marker.getLatLng();
            latitudeInput.value = newPosition.lat;
            longitudeInput.value = newPosition.lng;
        });

        // Find My Location functionality
        document.getElementById('findMyLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                // Show loading state
                this.textContent = 'Mencari lokasi...';
                this.disabled = true;
                
                navigator.geolocation.getCurrentPosition(
                    // Success callback
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        
                        // Update map and marker
                        map.setView([userLat, userLng], 16);
                        marker.setLatLng([userLat, userLng]);
                        
                        // Update form inputs
                        latitudeInput.value = userLat;
                        longitudeInput.value = userLng;
                        
                        // Reset button
                        const button = document.getElementById('findMyLocation');
                        button.innerHTML = '<i class="fas fa-location-arrow mr-1"></i> Temukan Lokasi Saya';
                        button.disabled = false;
                    },
                    // Error callback
                    function(error) {
                        let errorMessage = 'Gagal mendapatkan lokasi.';
                        
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = 'Anda menolak akses lokasi.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = 'Informasi lokasi tidak tersedia.';
                                break;
                            case error.TIMEOUT:
                                errorMessage = 'Waktu permintaan lokasi habis.';
                                break;
                        }
                        
                        alert(errorMessage);
                        
                        // Reset button
                        const button = document.getElementById('findMyLocation');
                        button.innerHTML = '<i class="fas fa-location-arrow mr-1"></i> Temukan Lokasi Saya';
                        button.disabled = false;
                    },
                    // Options
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                alert('Browser Anda tidak mendukung geolokasi.');
            }
        });
    </script>
    @endpush
</x-app-layout>