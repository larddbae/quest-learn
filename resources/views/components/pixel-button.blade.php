{{--
    Pixel Button Component
    
    Usage:
    <x-pixel-button variant="gold" size="md" href="/path">BUTTON TEXT</x-pixel-button>
    <x-pixel-button variant="green" type="submit">SUBMIT</x-pixel-button>
    
    Props:
    - variant: gold (default), green, red, blue, purple, ghost
    - size: sm, md (default), lg
    - href: If provided, renders as <a> tag. Otherwise renders as <button>
    - type: button (default), submit, reset — only for <button>
    - class: Additional classes to merge
    - icon: Material Symbols icon name (optional, rendered before slot)
    - full: If true, renders w-full
--}}

@props([
    'variant' => 'gold',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'full' => false,
])

@php
    // Variant color map
    $variantClasses = match($variant) {
        'gold' => 'bg-primary-container text-black hover:bg-primary-fixed',
        'green' => 'bg-secondary-container text-black hover:bg-secondary-fixed',
        'red' => 'bg-error-container text-white hover:brightness-110',
        'blue' => 'bg-[#3a86ff] text-white hover:brightness-110',
        'purple' => 'bg-tertiary-fixed-dim text-black hover:brightness-110',
        'ghost' => 'bg-surface-container-high text-on-surface border-surface-variant hover:bg-surface-container-highest',
        default => 'bg-primary-container text-black hover:bg-primary-fixed',
    };

    // Size map
    $sizeClasses = match($size) {
        'sm' => 'font-label text-[0.55rem] px-4 py-2 border-3 shadow-[3px_3px_0px_0px_#000000]',
        'md' => 'font-label text-[0.7rem] px-6 py-3 border-4 shadow-[4px_4px_0px_0px_#000000]',
        'lg' => 'font-label text-sm px-10 py-6 border-4 shadow-[4px_4px_0px_0px_#000000]',
        default => 'font-label text-[0.7rem] px-6 py-3 border-4 shadow-[4px_4px_0px_0px_#000000]',
    };

    $widthClass = $full ? 'w-full' : '';

    $baseClasses = "inline-flex items-center justify-center gap-2 border-black uppercase tracking-wider cursor-pointer transition-all duration-75 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none text-center no-underline {$variantClasses} {$sizeClasses} {$widthClass}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        @if($icon)
            <span class="material-symbols-outlined text-current" style="font-size: inherit;">{{ $icon }}</span>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        @if($icon)
            <span class="material-symbols-outlined text-current" style="font-size: inherit;">{{ $icon }}</span>
        @endif
        {{ $slot }}
    </button>
@endif
