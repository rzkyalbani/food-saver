@props(['currentStep' => 1, 'totalSteps' => 3])

<div class="my-6">
    <div class="flex items-center justify-between mb-2">
        @for ($i = 1; $i <= $totalSteps; $i++)
            <div class="flex items-center">
                <div
                    class="w-10 h-10 flex items-center justify-center rounded-full {{ $i <= $currentStep ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600' }} font-semibold">
                    {{ $i }}
                </div>
                <div class="ml-2 hidden sm:block">
                    <p class="text-sm font-medium {{ $i <= $currentStep ? 'text-gray-800' : 'text-gray-500' }}">
                        @switch($i)
                            @case(1)
                                Informasi Dasar
                            @break

                            @case(2)
                                Lokasi Toko
                            @break

                            @case(3)
                                Konfirmasi
                            @break

                            @default
                                Langkah {{ $i }}
                        @endswitch
                    </p>
                </div>
            </div>

            @if ($i < $totalSteps)
                <div class="w-full h-1 mx-2 bg-gray-200">
                    <div class="h-full {{ $i < $currentStep ? 'bg-primary' : 'bg-gray-200' }}"
                        style="width: {{ $i < $currentStep ? '100%' : ($i == $currentStep ? '50%' : '0%') }}"></div>
                </div>
            @endif
        @endfor
    </div>
    <div class="w-full h-1 mt-1 hidden">
        <div class="h-full bg-primary" style="width: {{ (($currentStep - 1) / ($totalSteps - 1)) * 100 }}%"></div>
    </div>
</div>
