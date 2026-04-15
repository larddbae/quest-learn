@extends('layouts.student')

@section('title', 'Quest Board')

@section('main')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-pixel text-lg text-pixel-gold mb-2">🗺️ QUEST BOARD</h1>
                <p class="font-pixel-body text-xl text-pixel-text-muted">
                    All available quests in your guild. Complete them in order to unlock the next!
                </p>
            </div>
            <div class="pixel-box-light p-4 text-center">
                <p class="font-pixel text-xl text-pixel-green">{{ $completedCount }}/{{ $totalCount }}</p>
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">QUESTS DONE</p>
            </div>
        </div>
    </div>

    @if($subjects->isEmpty())
        <div class="pixel-box p-12 text-center">
            <div class="text-6xl mb-4">🗺️</div>
            <h2 class="font-pixel text-sm text-pixel-text-muted mb-2">NO QUESTS AVAILABLE</h2>
            <p class="font-pixel-body text-xl text-pixel-text-muted">
                Your Game Master hasn't posted any quests yet. Check back soon!
            </p>
        </div>
    @else
        @foreach($subjects as $subject)
            @if($subject->quests->count() > 0)
                <div class="mb-8">
                    {{-- Subject Header --}}
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">{{ $subject->icon ?? '📖' }}</span>
                        <div>
                            <h2 class="font-pixel text-sm text-pixel-gold">{{ $subject->name }}</h2>
                            @if($subject->description)
                                <p class="font-pixel-body text-lg text-pixel-text-muted">{{ $subject->description }}</p>
                            @endif
                        </div>
                        <a href="{{ route('student.quests.index', $subject) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm ml-auto">
                            VIEW ALL
                        </a>
                    </div>

                    {{-- Quest Cards --}}
                    <div class="space-y-3">
                        @foreach($subject->quests as $index => $quest)
                            <div class="pixel-card {{ !$quest->is_unlocked ? 'pixel-card-locked' : '' }} p-5">
                                <div class="flex items-center gap-4">
                                    {{-- Status Icon --}}
                                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center text-3xl">
                                        @if(!$quest->is_unlocked)
                                            🔒
                                        @elseif($quest->progress && $quest->progress->is_completed)
                                            ✅
                                        @else
                                            ⚔️
                                        @endif
                                    </div>

                                    {{-- Quest Info --}}
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-pixel text-[10px] text-pixel-text mb-1 truncate">
                                            QUEST {{ $index + 1 }}: {{ $quest->title }}
                                        </h3>
                                        @if($quest->description)
                                            <p class="font-pixel-body text-lg text-pixel-text-muted truncate">{{ $quest->description }}</p>
                                        @endif
                                        <div class="flex items-center gap-4 mt-1">
                                            <span class="font-pixel text-[8px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>
                                            @if($quest->progress && $quest->progress->is_completed)
                                                <span class="font-pixel text-[8px] text-pixel-green">
                                                    ✓ {{ $quest->progress->score }}/{{ $quest->progress->total_questions }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Action --}}
                                    <div class="flex-shrink-0">
                                        @if(!$quest->is_unlocked)
                                            <span class="font-pixel text-[8px] text-pixel-text-muted">LOCKED</span>
                                        @elseif($quest->progress && $quest->progress->is_completed)
                                            <a href="{{ route('student.materials.show', $quest) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm">
                                                REVIEW
                                            </a>
                                        @else
                                            <a href="{{ route('student.materials.show', $quest) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm animate-glow">
                                                BEGIN
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection
