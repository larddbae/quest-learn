@extends('layouts.admin')
@section('title', 'Badge Forge')
@section('main')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold">🏅 BADGE FORGE</h1>
        <a href="{{ route('admin.badges.create') }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ FORGE BADGE</a>
    </div>

    @if($badges->isEmpty())
        <div class="pixel-box p-12 text-center">
            <div class="text-5xl mb-4">⚒️</div>
            <p class="font-pixel text-[10px] text-pixel-text-muted mb-4">No badges forged yet.</p>
            <a href="{{ route('admin.badges.create') }}" class="pixel-btn pixel-btn-gold">⚒️ FORGE YOUR FIRST BADGE</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($badges as $badge)
                <div class="pixel-card p-6 text-center">
                    @if($badge->icon_path)
                        <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->name }}" class="w-16 h-16 mx-auto pixel-image mb-3">
                    @else
                        <div class="text-5xl mb-3">🏅</div>
                    @endif
                    <h3 class="font-pixel text-[10px] text-pixel-gold mb-2">{{ $badge->name }}</h3>
                    <p class="font-pixel-body text-base text-pixel-text-muted mb-3">{{ $badge->description }}</p>
                    <div class="pixel-box-light p-2 mb-3">
                        <p class="font-pixel text-[8px] text-pixel-cyan">
                            {{ str_replace('_', ' ', strtoupper($badge->criteria_type)) }}: {{ $badge->criteria_value }}
                        </p>
                    </div>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('admin.badges.edit', $badge) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️</a>
                        <form method="POST" action="{{ route('admin.badges.destroy', $badge) }}" class="inline"
                              onsubmit="return confirm('Destroy this badge?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
