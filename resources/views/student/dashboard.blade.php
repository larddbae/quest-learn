@extends('layouts.student')

@section('title', 'Player Dashboard')

@section('main')
<div class="max-w-6xl mx-auto">
    {{-- Player Character Card --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Avatar --}}
            <div class="text-center">
                <div class="text-7xl animate-float pixel-image">{{ $user->avatar ?? '🧙' }}</div>
            </div>

            {{-- Stats --}}
            <div class="flex-1 w-full">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-3">
                    <div>
                        <h1 class="font-pixel text-sm text-pixel-gold">{{ $user->name }}</h1>
                        <p class="font-pixel-body text-xl text-pixel-text-muted mt-1">
                            {{ $user->classroom->name ?? 'No Guild' }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3 mt-2 md:mt-0">
                        <span class="rank-badge rank-{{ strtolower($user->rank) }}">{{ $user->rank }}</span>
                    </div>
                </div>

                {{-- Level & XP Bar --}}
                <div class="mb-3">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-pixel text-[10px] text-pixel-green">LVL {{ $user->level }}</span>
                        <span class="font-pixel text-[9px] text-pixel-text-muted">
                            {{ $user->xp }} / {{ $user->xpForNextLevel() }} XP
                        </span>
                    </div>
                    <div class="xp-bar-container">
                        <div class="xp-bar-fill" style="width: {{ $user->xpProgressPercent() }}%"></div>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="pixel-box-light p-3 text-center">
                        <p class="font-pixel text-lg text-pixel-gold">{{ $completedQuests }}</p>
                        <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">QUESTS</p>
                    </div>
                    <div class="pixel-box-light p-3 text-center">
                        <p class="font-pixel text-lg text-pixel-cyan">{{ number_format($totalXP) }}</p>
                        <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">TOTAL XP</p>
                    </div>
                    <div class="pixel-box-light p-3 text-center">
                        <p class="font-pixel text-lg text-pixel-purple">{{ $user->badges->count() }}</p>
                        <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">BADGES</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Recent Activity --}}
        <div class="pixel-box p-6">
            <h2 class="font-pixel text-[11px] text-pixel-gold mb-4">📜 RECENT QUESTS</h2>

            @forelse($recentProgress as $progress)
                <div class="flex items-center gap-3 mb-3 p-3 pixel-box-light">
                    <span class="text-2xl">✅</span>
                    <div class="flex-1">
                        <p class="font-pixel text-[9px] text-pixel-text">{{ $progress->quest->title }}</p>
                        <p class="font-pixel-body text-base text-pixel-text-muted">
                            {{ $progress->quest->subject->name ?? '' }} • Score: {{ $progress->score }}/{{ $progress->total_questions }}
                        </p>
                    </div>
                    <span class="font-pixel text-[9px] text-pixel-green">+{{ $progress->quest->xp_reward }}XP</span>
                </div>
            @empty
                <div class="text-center p-6">
                    <div class="text-4xl mb-2">🗺️</div>
                    <p class="font-pixel text-[9px] text-pixel-text-muted">No quests completed yet.</p>
                    <a href="{{ route('student.subjects.index') }}" class="pixel-btn pixel-btn-gold pixel-btn-sm mt-3">
                        START QUESTING
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Recent Badges --}}
        <div class="pixel-box p-6">
            <h2 class="font-pixel text-[11px] text-pixel-gold mb-4">🏅 RECENT BADGES</h2>

            @forelse($recentBadges as $badge)
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
                <div class="text-center p-6">
                    <div class="text-4xl mb-2">🎖️</div>
                    <p class="font-pixel text-[9px] text-pixel-text-muted">No badges earned yet. Keep questing!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
