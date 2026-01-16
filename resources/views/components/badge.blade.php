<!-- resources/views/components/badge.blade.php (BONUS) -->
@props([
    'variant' => 'primary', // primary, secondary, success, danger, warning, info
    'size' => 'md', // sm, md, lg
    'rounded' => true,
    'icon' => null,
])

@php
    $variants = [
        'primary' => 'bg-blue-100 text-blue-700',
        'secondary' => 'bg-purple-100 text-purple-700',
        'success' => 'bg-green-100 text-green-700',
        'danger' => 'bg-red-100 text-red-700',
        'warning' => 'bg-yellow-100 text-yellow-700',
        'info' => 'bg-gray-100 text-gray-700',
    ];
    
    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-xs',
        'lg' => 'px-3 py-1.5 text-sm',
    ];
    
    $roundedClass = $rounded ? 'rounded-full' : 'rounded';
    
    $classes = "inline-flex items-center font-medium {$variants[$variant]} {$sizes[$size]} {$roundedClass}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
    <i class="fas {{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</span>

