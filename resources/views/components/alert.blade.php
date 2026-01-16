<!-- resources/views/components/alert.blade.php -->
@props([
    'type' => 'info', // info, success, warning, error
    'icon' => null,
    'dismissible' => true,
    'title' => null
])

@php
    $classes = [
        'info' => 'bg-blue-50 border-blue-500 text-blue-700',
        'success' => 'bg-green-50 border-green-500 text-green-700',
        'warning' => 'bg-yellow-50 border-yellow-500 text-yellow-700',
        'error' => 'bg-red-50 border-red-500 text-red-700',
    ];
    
    $icons = [
        'info' => 'fa-info-circle',
        'success' => 'fa-check-circle',
        'warning' => 'fa-exclamation-triangle',
        'error' => 'fa-exclamation-circle',
    ];
    
    $iconClass = $icon ?? $icons[$type];
@endphp

<div {{ $attributes->merge(['class' => "border-l-4 p-4 rounded {$classes[$type]}"]) }} 
     x-data="{ show: true }" 
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-90">
    <div class="flex items-start">
        <i class="fas {{ $iconClass }} text-lg mr-3 mt-0.5 flex-shrink-0"></i>
        <div class="flex-1">
            @if($title)
            <p class="font-semibold mb-1">{{ $title }}</p>
            @endif
            <div class="text-sm">
                {{ $slot }}
            </div>
        </div>
        @if($dismissible)
        <button @click="show = false" class="ml-3 flex-shrink-0 hover:opacity-70 transition">
            <i class="fas fa-times"></i>
        </button>
        @endif
    </div>
</div>