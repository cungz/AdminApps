<!-- resources/views/components/card.blade.php -->
@props([
    'title' => null,
    'subtitle' => null,
    'padding' => true,
    'divided' => false,
    'footer' => null,
    'headerAction' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-100']) }}>
    @if($title || $headerAction)
    <div class="px-6 py-4 border-b border-gray-100 {{ $divided ? 'bg-gray-50' : '' }}">
        <div class="flex items-center justify-between">
            <div>
                @if($title)
                <h3 class="text-lg font-bold text-gray-800">{{ $title }}</h3>
                @endif
                @if($subtitle)
                <p class="text-sm text-gray-600 mt-1">{{ $subtitle }}</p>
                @endif
            </div>
            @if($headerAction)
            <div>
                {{ $headerAction }}
            </div>
            @endif
        </div>
    </div>
    @endif
    
    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>
    
    @if($footer)
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        {{ $footer }}
    </div>
    @endif
</div>

