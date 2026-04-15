@extends('layouts.student')

@section('title', 'Profile & Inventory')

@section('main')
<div class="max-w-4xl mx-auto">
    {{-- Profile Card --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="text-7xl animate-float pixel-image">{{ $user->avatar ?? '🧙' }}</div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="font-pixel text-lg text-pixel-gold">{{ $user->name }}</h1>
                <p class="font-pixel-body text-xl text-pixel-text-muted">{{ $user->classroom->name ?? 'No Guild' }}</p>
                <div class="flex items-center gap-3 justify-center md:justify-start mt-2">
                    <span class="rank-badge rank-{{ strtolower($user->rank) }}">{{ $user->rank }}</span>
                    <span class="font-pixel text-[10px] text-pixel-green">LVL {{ $user->level }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-gold">{{ $completedQuests }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">QUESTS DONE</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-cyan">{{ number_format($totalXP) }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">TOTAL XP</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-green">{{ $perfectScores }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">PERFECT SCORES</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-purple">{{ $badges->count() }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">BADGES</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Badge Inventory --}}
        <div class="pixel-box p-6">
            <h2 class="font-pixel text-[11px] text-pixel-gold mb-4">🏅 BADGE INVENTORY</h2>

            @forelse($badges as $badge)
                <div class="flex items-center gap-3 mb-3 p-3 pixel-box-light">
                    @if($badge->icon_path)
                        <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->name }}" class="w-10 h-10 pixel-image">
                    @else
                        <span class="text-3xl">🏅</span>
                    @endif
                    <div>
                        <p class="font-pixel text-[9px] text-pixel-gold">{{ $badge->name }}</p>
                        <p class="font-pixel-body text-base text-pixel-text-muted">{{ $badge->description }}</p>
                    </div>
                </div>
            @empty
                <p class="font-pixel text-[9px] text-pixel-text-muted text-center p-4">No badges earned yet.</p>
            @endforelse
        </div>

        {{-- Bookmarks --}}
        <div class="pixel-box p-6">
            <h2 class="font-pixel text-[11px] text-pixel-gold mb-4">📚 BOOKMARKED MATERIALS</h2>

            @forelse($bookmarks as $bookmark)
                <a href="{{ route('student.materials.show', $bookmark->material->quest_id) }}"
                   class="flex items-center gap-3 mb-3 p-3 pixel-box-light hover:bg-pixel-surface-light transition-colors">
                    <span class="text-2xl">📑</span>
                    <div>
                        <p class="font-pixel text-[9px] text-pixel-text">{{ $bookmark->material->title }}</p>
                        <p class="font-pixel-body text-base text-pixel-text-muted">
                            {{ $bookmark->material->quest->subject->name ?? '' }} • {{ $bookmark->material->quest->title ?? '' }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="font-pixel text-[9px] text-pixel-text-muted text-center p-4">No bookmarks yet. Save materials you want to review!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
