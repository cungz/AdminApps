<!-- resources/views/components/input.blade.php (BONUS) -->
@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'required' => false,
    'error' => null,
    'icon' => null,
    'helper' => null,
])

<div {{ $attributes->only('class') }}>
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    
    <div class="relative">
        @if($icon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas {{ $icon }} text-gray-400"></i>
        </div>
        @endif
        
        <input 
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->except('class')->merge([
                'class' => 'w-full ' . ($icon ? 'pl-10 ' : '') . 'pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition' . ($error ? ' border-red-500' : '')
            ]) }}
            @if($required) required @endif>
    </div>
    
    @if($helper)
    <p class="text-xs text-gray-500 mt-1">{{ $helper }}</p>
    @endif
    
    @if($error)
    <p class="text-red-500 text-sm mt-1">{{ $error }}</p>
    @endif
</div>

