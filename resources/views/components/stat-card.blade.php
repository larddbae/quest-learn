{{--
    Stat Card Component — Admin Dashboard Stat Display

    Usage:
    <x-stat-card 
        label="TOTAL STUDENTS" 
        :value="$totalStudents" 
        icon="groups" 
        color="blue" 
    />

    Props:
    - label: Stat label text (displayed in small pixel font, supports <br/> via {!! !!})
    - value: The numeric/text value to display large
    - icon: Material Symbols icon name
    - color: gold, green, blue, white (default: gold) — controls text/icon color
    - class: Additional classes to merge
--}}

@props([
    'label' => 'STAT',
    'value' => '0',
    'icon' => 'star',
    'color' => 'gold',
])

@php
    $colorClass = match($color) {
        'gold' => 'text-primary-container',
        'green' => 'text-secondary-container',
        'blue' => 'text-tertiary-fixed-dim',
        'white' => 'text-[#f5f6ff]',
        'red' => 'text-error',
        default => 'text-primary-container',
    };
@endphp

<div {{ $attributes->merge(['class' => 'bg-surface-container-low pixel-border pixel-shadow p-6 flex flex-col justify-between']) }}>
    <div class="flex justify-between items-start">
        <span class="font-label text-[0.6rem] {{ $colorClass }} leading-tight uppercase">
            {!! $label !!}
        </span>
        <span class="material-symbols-outlined {{ $colorClass }} text-3xl" style="font-variation-settings: 'FILL' 1;">
            {{ $icon }}
        </span>
    </div>
    <div class="{{ $colorClass }} font-body text-6xl mt-4">
        {{ $value }}
    </div>
</div>
