@props(['variant' => 'primary', 'size' => 'md'])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg shadow-md transition duration-300';

    $variantClasses = [
        'primary' => 'bg-primary hover:bg-primary-dark text-white',
        'secondary' => 'bg-secondary hover:bg-secondary-dark text-white',
        'white' => 'bg-white hover:bg-gray-100 text-primary border border-gray-200',
        'outline-primary' => 'bg-transparent hover:bg-primary/10 text-primary border border-primary',
        'outline-secondary' => 'bg-transparent hover:bg-secondary/10 text-secondary border border-secondary',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
