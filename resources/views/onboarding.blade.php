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
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pendaftaran Toko</h3>

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

                    <!-- Indikator Progress -->
                    <x-onboarding-progress :currentStep="$step" :totalSteps="3" />

                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                        <div class="lg:col-span-3">
                            <!-- Step 1: Informasi Dasar -->
                            @if ($step == 1)
                                <form method="POST" action="{{ route('onboarding.storeStep1') }}" id="step1Form">
                                    @csrf
                                    <div>
                                        <label for="store_name" class="block font-medium text-sm text-gray-700">Nama Toko</label>
                                        <x-input id="store_name" name="store_name" type="text" class="mt-1 block w-full"
                                            value="{{ old('store_name', $storeData['store_name'] ?? '') }}" required />
                                        <p class="mt-1 text-xs text-gray-500">Nama toko yang akan ditampilkan kepada pelanggan.</p>
                                    </div>

                                    <div class="mt-4">
                                        <label for="store_description" class="block font-medium text-sm text-gray-700">Deskripsi
                                            Toko</label>
                                        <x-textarea id="store_description" name="store_description" class="mt-1 block w-full"
                                            rows="3" required>{{ old('store_description', $storeData['store_description'] ?? '') }}</x-textarea>
                                        <p class="mt-1 text-xs text-gray-500">Ceritakan tentang toko Anda, jenis makanan yang
                                            dijual, dll.</p>
                                    </div>

                                    <div class="mt-4">
                                        <label for="store_phone_number" class="block font-medium text-sm text-gray-700">Nomor
                                            Telepon Toko</label>
                                        <x-input id="store_phone_number" name="store_phone_number" type="text"
                                            class="mt-1 block w-full" value="{{ old('store_phone_number', $storeData['store_phone_number'] ?? '') }}" required />
                                        <p class="mt-1 text-xs text-gray-500">Nomor telepon yang dapat dihubungi pelanggan.</p>
                                    </div>

                                    <div class="flex items-center justify-end mt-6">
                                        <x-button variant="primary" size="lg">
                                            Lanjutkan
                                        </x-button>
                                    </div>
                                </form>
                            @endif

                            <!-- Step 2: Lokasi Toko -->
                            @if ($step == 2)
                                <form method="POST" action="{{ route('onboarding.storeStep2') }}">
                                    @csrf
                                    <div>
                                        <label for="store_address" class="block font-medium text-sm text-gray-700">Alamat
                                            Toko</label>
                                        <x-textarea id="store_address" name="store_address" class="mt-1 block w-full" rows="2"
                                            required>{{ old('store_address', $storeData['store_address'] ?? '') }}</x-textarea>
                                        <p class="mt-1 text-xs text-gray-500">Alamat lengkap dimana pelanggan dapat mengambil
                                            pesanan.</p>
                                    </div>

                                    <div class="mt-4">
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Lokasi Toko di Peta</label>
                                        <div id="map-container" class="relative">
                                            <div id="map" style="height: 350px; border-radius: 0.375rem;"
                                                class="border border-gray-300 rounded-md"></div>
                                            <div id="map-loading"
                                                class="hidden absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center rounded-md">
                                                <div class="text-center">
                                                    <svg class="animate-spin h-8 w-8 mx-auto text-amber-600"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    <p class="mt-2 text-sm text-gray-700">Mencari lokasi...</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Geser pin pada peta atau gunakan tombol di bawah untuk
                                            menentukan lokasi toko Anda.</p>
                                        <div class="mt-2 flex items-center">
                                            <button type="button" id="findMyLocation"
                                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Temukan Lokasi Saya
                                            </button>
                                            <span id="location-status" class="ml-3 text-sm text-gray-600 hidden"></span>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
                                            <div>
                                                <label for="store_latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
                                                <x-input id="store_latitude" name="store_latitude" type="text"
                                                    class="mt-1 block w-full bg-gray-50"
                                                    value="{{ old('store_latitude', $storeData['store_latitude'] ?? '') }}" readonly required />
                                            </div>
                                            <div>
                                                <label for="store_longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
                                                <x-input id="store_longitude" name="store_longitude" type="text"
                                                    class="mt-1 block w-full bg-gray-50"
                                                    value="{{ old('store_longitude', $storeData['store_longitude'] ?? '') }}" readonly required />
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between mt-6">
                                            <a href="{{ route('onboarding.back') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                                ← Kembali
                                            </a>
                                            <x-button variant="primary" size="lg">
                                                Lanjutkan
                                            </x-button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            <!-- Step 3: Konfirmasi -->
                            @if ($step == 3)
                                <form method="POST" action="{{ route('onboarding.process') }}">
                                    @csrf
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="font-semibold text-lg text-gray-800 mb-3">Konfirmasi Data Toko</h4>
                                        <p class="text-sm text-gray-600 mb-4">Periksa kembali informasi toko Anda sebelum mendaftar.</p>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-3">
                                                <h5 class="text-sm font-medium text-gray-700">Nama Toko:</h5>
                                                <p class="text-sm">{{ $storeData['store_name'] ?? 'Tidak ada data' }}</p>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h5 class="text-sm font-medium text-gray-700">Nomor Telepon:</h5>
                                                <p class="text-sm">{{ $storeData['store_phone_number'] ?? 'Tidak ada data' }}</p>
                                            </div>
                                            
                                            <div class="mb-3 md:col-span-2">
                                                <h5 class="text-sm font-medium text-gray-700">Alamat:</h5>
                                                <p class="text-sm">{{ $storeData['store_address'] ?? 'Tidak ada data' }}</p>
                                            </div>
                                            
                                            <div class="mb-3 md:col-span-2">
                                                <h5 class="text-sm font-medium text-gray-700">Deskripsi:</h5>
                                                <p class="text-sm">{{ $storeData['store_description'] ?? 'Tidak ada data' }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-yellow-700">
                                                        Setelah pendaftaran, toko Anda akan ditinjau oleh tim kami sebelum dapat aktif.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-6">
                                        <a href="{{ route('onboarding.back') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                            ← Kembali
                                        </a>
                                        <x-button variant="primary" size="lg">
                                            Daftarkan Toko
                                        </x-button>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <!-- Preview Toko (Live) -->
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 sticky top-4">
                                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Preview Toko
                                </h4>
                                <div class="overflow-hidden rounded-lg shadow-sm">
                                    <div class="relative h-32 bg-gradient-to-r from-primary to-primary-dark flex items-end">
                                        <div class="absolute inset-0 bg-black opacity-40"></div>
                                        <div class="relative p-4 text-white">
                                            <h3 class="font-bold text-xl" id="preview-name">{{ $storeData['store_name'] ?? 'Nama Toko Anda' }}</h3>
                                        </div>
                                    </div>
                                    <div class="bg-white p-4">
                                        <div class="text-sm text-gray-600 flex items-start mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            <span id="preview-address">{{ $storeData['store_address'] ?? 'Alamat toko akan ditampilkan di sini' }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600 flex items-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                            </svg>
                                            <span id="preview-phone">{{ $storeData['store_phone_number'] ?? 'Nomor telepon toko' }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="text-sm font-medium text-gray-700 mb-1">Tentang Toko:</h4>
                                            <p class="text-sm text-gray-600" id="preview-description">{{ $storeData['store_description'] ?? 'Deskripsi toko Anda akan ditampilkan di sini. Berikan informasi menarik tentang produk yang Anda tawarkan.' }}</p>
                                        </div>
                                        @if(isset($storeData['store_latitude']) && isset($storeData['store_longitude']))
                                        <div class="mt-4">
                                            <h4 class="text-sm font-medium text-gray-700 mb-1">Lokasi di Peta:</h4>
                                            <div id="preview-map" style="height: 150px; border-radius: 0.375rem;" class="border border-gray-200"></div>
                                        </div>
                                        @endif

                                        <div class="mt-4">
                                            <div class="bg-primary-light/10 text-primary-dark text-sm p-3 rounded-md">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span>Setelah terdaftar, tunggu persetujuan Admin untuk mulai menawarkan produk.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Update preview saat input berubah
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk update preview
            function updatePreview() {
                const storeName = document.getElementById('store_name')?.value || "{{ $storeData['store_name'] ?? 'Nama Toko Anda' }}";
                const storeDesc = document.getElementById('store_description')?.value || "{{ $storeData['store_description'] ?? 'Deskripsi toko Anda akan ditampilkan di sini.' }}";
                const storeAddress = document.getElementById('store_address')?.value || "{{ $storeData['store_address'] ?? 'Alamat toko akan ditampilkan di sini' }}";
                const storePhone = document.getElementById('store_phone_number')?.value || "{{ $storeData['store_phone_number'] ?? 'Nomor telepon toko' }}";
                
                document.getElementById('preview-name').textContent = storeName;
                document.getElementById('preview-description').textContent = storeDesc;
                document.getElementById('preview-address').textContent = storeAddress;
                document.getElementById('preview-phone').textContent = storePhone;
            }
            
            // Update preview saat pertama kali
            updatePreview();
            
            // Update preview saat input berubah (hanya untuk step 1 dan 2)
            if ({{ $step }} <= 2) {
                const inputs = document.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    input.addEventListener('input', updatePreview);
                });
            }
            
            // Jika ada data latitude/longitude, inisialisasi peta preview
            @if(isset($storeData['store_latitude']) && isset($storeData['store_longitude']))
            const previewMap = L.map('preview-map').setView([{{ $storeData['store_latitude'] }}, {{ $storeData['store_longitude'] }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(previewMap);
            L.marker([{{ $storeData['store_latitude'] }}, {{ $storeData['store_longitude'] }}]).addTo(previewMap);
            // Disable zoom dan interaksi
            previewMap.scrollWheelZoom.disable();
            previewMap.dragging.disable();
            @endif
            
            // Inisialisasi peta utama (hanya untuk step 2)
            @if($step == 2)
            // Koordinat default (misal: tengah Indonesia atau kota besar)
            // Gunakan old() jika ada, untuk mempertahankan input setelah validasi error
            const defaultLatitude = {{ old('store_latitude', $storeData['store_latitude'] ?? -2.5489) }};
            const defaultLongitude = {{ old('store_longitude', $storeData['store_longitude'] ?? 118.0149) }};
            const initialZoom = {{ isset($storeData['store_latitude']) ? 15 : 5 }};

            const map = L.map('map').setView([defaultLatitude, defaultLongitude], initialZoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([defaultLatitude, defaultLongitude], {
                draggable: true
            }).addTo(map);

            const latitudeInput = document.getElementById('store_latitude');
            const longitudeInput = document.getElementById('store_longitude');
            const mapLoading = document.getElementById('map-loading');
            const locationStatus = document.getElementById('location-status');

            // Set nilai awal ke input form
            latitudeInput.value = defaultLatitude;
            longitudeInput.value = defaultLongitude;

            // Event listener saat marker digeser
            marker.on('dragend', function() {
                const position = marker.getLatLng();
                latitudeInput.value = position.lat.toFixed(6);
                longitudeInput.value = position.lng.toFixed(6);

                // Tampilkan status update
                locationStatus.textContent = 'Lokasi diperbarui secara manual';
                locationStatus.className = 'ml-3 text-sm text-green-600';
                locationStatus.classList.remove('hidden');

                // Sembunyikan status setelah 3 detik
                setTimeout(() => {
                    locationStatus.classList.add('hidden');
                }, 3000);
            });

            // Find My Location functionality
            document.getElementById('findMyLocation').addEventListener('click', function() {
                const button = this;
                button.disabled = true;

                // Tampilkan loading overlay
                mapLoading.classList.remove('hidden');

                // Tampilkan status
                locationStatus.textContent = 'Mencari lokasi Anda...';
                locationStatus.className = 'ml-3 text-sm text-amber-600';
                locationStatus.classList.remove('hidden');

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            
                            // Update nilai input
                            latitudeInput.value = lat.toFixed(6);
                            longitudeInput.value = lng.toFixed(6);
                            marker.setLatLng([lat, lng]);
                            map.setView([lat, lng], 16); // Zoom lebih dekat saat lokasi ditemukan

                            // Sembunyikan loading overlay
                            mapLoading.classList.add('hidden');

                            // Update status
                            locationStatus.textContent = 'Lokasi berhasil ditemukan!';
                            locationStatus.className = 'ml-3 text-sm text-green-600';

                            // Reset button
                            button.disabled = false;

                            // Sembunyikan status setelah 3 detik
                            setTimeout(() => {
                                locationStatus.classList.add('hidden');
                            }, 3000);
                        },
                        function(error) {
                            // Sembunyikan loading overlay
                            mapLoading.classList.add('hidden');

                            // Reset button
                            button.disabled = false;

                            // Tampilkan error
                            let message = 'Gagal mendapatkan lokasi: ';
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    message +=
                                        "Anda menolak permintaan Geolokasi. Periksa pengaturan browser Anda.";
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    message += "Informasi lokasi tidak tersedia. Pastikan GPS Anda aktif.";
                                    break;
                                case error.TIMEOUT:
                                    message +=
                                        "Waktu permintaan untuk mendapatkan lokasi pengguna habis. Coba lagi.";
                                    break;
                                case error.UNKNOWN_ERROR:
                                    message += "Terjadi kesalahan yang tidak diketahui. Coba lagi nanti.";
                                    break;
                            }

                            locationStatus.textContent = message;
                            locationStatus.className = 'ml-3 text-sm text-red-600';

                            // Sembunyikan status error setelah 5 detik
                            setTimeout(() => {
                                locationStatus.classList.add('hidden');
                            }, 5000);
                        }, {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 0
                        }
                    );
                } else {
                    // Sembunyikan loading overlay
                    mapLoading.classList.add('hidden');

                    // Reset button
                    button.disabled = false;

                    // Tampilkan error
                    locationStatus.textContent = 'Browser Anda tidak mendukung geolokasi.';
                    locationStatus.className = 'ml-3 text-sm text-red-600';

                    // Sembunyikan status error setelah 5 detik
                    setTimeout(() => {
                        locationStatus.classList.add('hidden');
                    }, 5000);
                }
            });
            @endif
        });
    </script>
    @endpush
</x-app-layout>