{{--
    Pixel Card Component
    
    Usage:
    <x-pixel-card>Card content here</x-pixel-card>
    <x-pixel-card variant="low" hover>Hoverable card</x-pixel-card>
    <x-pixel-card variant="high" padding="lg" locked>Locked content</x-pixel-card>
    
    Props:
    - variant: default, low, high, highest — controls background surface level
    - padding: none, sm, md (default), lg
    - hover: boolean — enables hover lift effect
    - locked: boolean — applies locked/grayed-out style
    - class: Additional classes to merge
--}}

@props([
    'variant' => 'default',
    'padding' => 'md',
    'hover' => false,
    'locked' => false,
])

@php
    $bgClass = match($variant) {
        'lowest' => 'bg-surface-container-lowest',
        'low' => 'bg-surface-container-low',
        'default' => 'bg-surface-container',
        'high' => 'bg-surface-container-high',
        'highest' => 'bg-surface-container-highest',
        default => 'bg-surface-container',
    };

    $padClass = match($padding) {
        'none' => '',
        'sm' => 'p-3',
        'md' => 'p-6',
        'lg' => 'p-8',
        default => 'p-6',
    };

    $hoverClass = $hover && !$locked
        ? 'hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[6px_6px_0px_0px_#000000] transition-all duration-100 cursor-pointer'
        : '';

    $lockedClass = $locked
        ? 'opacity-50 grayscale-[50%] pointer-events-none'
        : '';

    $baseClasses = "pixel-border {$bgClass} {$padClass} {$hoverClass} {$lockedClass}";
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    {{ $slot }}
</div>
