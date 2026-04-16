{{--
    XP Bar Component — Segmented Pixel Progress Bar

    Usage:
    <x-xp-bar :current="740" :max="1000" />
    <x-xp-bar :current="$user->xp" :max="$user->xpForNextLevel()" :segments="10" label="XP_PROGRESS" />
    <x-xp-bar :current="60" :max="100" color="gold" height="md" />

    Props:
    - current: Current value (required)
    - max: Maximum value (required)
    - segments: Number of segments (default: 10)
    - label: Optional label text above the bar
    - showValues: Show numeric values (default: true)
    - color: green (default), gold, blue, red
    - height: sm, md (default), lg
--}}

@props([
    'current' => 0,
    'max' => 100,
    'segments' => 10,
    'label' => null,
    'showValues' => true,
    'color' => 'green',
    'height' => 'md',
])

@php
    $percent = $max > 0 ? min(($current / $max) * 100, 100) : 0;
    $filledSegments = round(($percent / 100) * $segments);

    $colorClass = match($color) {
        'green' => 'bg-secondary-container',
        'gold' => 'bg-primary-container',
        'blue' => 'bg-[#3a86ff]',
        'red' => 'bg-error',
        default => 'bg-secondary-container',
    };

    $heightClass = match($height) {
        'sm' => 'h-4',
        'md' => 'h-6',
        'lg' => 'h-8',
        default => 'h-6',
    };
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-1']) }}>
    {{-- Label Row --}}
    @if($label || $showValues)
        <div class="flex justify-between font-label text-[10px] uppercase">
            @if($label)
                <span>{{ $label }}</span>
            @endif
            @if($showValues)
                <span class="ml-auto">{{ number_format($current) }}/{{ number_format($max) }}</span>
            @endif
        </div>
    @endif

    {{-- Segmented Bar --}}
    <div class="{{ $heightClass }} w-full bg-surface-container-lowest border-2 border-black flex gap-0.5 p-0.5">
        @for($i = 0; $i < $segments; $i++)
            <div class="flex-1 {{ $i < $filledSegments ? $colorClass : 'bg-surface-container-lowest' }}"></div>
        @endfor
    </div>
</div>
