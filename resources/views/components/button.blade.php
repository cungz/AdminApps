<!-- resources/views/components/button.blade.php -->
@props([
    'type' => 'button', // button, submit, reset
    'variant' => 'primary', // primary, secondary, success, danger, warning, white
    'size' => 'md', // xs, sm, md, lg, xl
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'loading' => false,
    'disabled' => false,
])

@php
    $variants = [
        'primary' => 'bg-primary hover:bg-blue-600 text-white',
        'secondary' => 'bg-secondary hover:bg-purple-600 text-white',
        'success' => 'bg-green-500 hover:bg-green-600 text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'white' => 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-300',
        'outline' => 'bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white',
    ];
    
    $sizes = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        'xl' => 'px-6 py-3 text-base',
    ];
    
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-primary disabled:opacity-50 disabled:cursor-not-allowed';
    
    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
    @if($disabled || $loading) disabled @endif>
    
    @if($loading)
        <i class="fas fa-spinner fa-spin mr-2"></i>
    @elseif($icon && $iconPosition === 'left')
        <i class="fas {{ $icon }} mr-2"></i>
    @endif
    
    {{ $slot }}
    
    @if($icon && $iconPosition === 'right' && !$loading)
        <i class="fas {{ $icon }} ml-2"></i>
    @endif
</button>

