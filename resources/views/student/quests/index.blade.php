@extends('layouts.student')

@section('title', $subject->name . ' — Quest Board')

@section('main')
<div class="max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.subjects.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold">
            ◀ SUBJECTS
        </a>
    </div>

    <h1 class="font-pixel text-lg text-pixel-gold mb-2">⚔️ {{ $subject->name }}</h1>
    <p class="font-pixel-body text-xl text-pixel-text-muted mb-6">{{ $subject->description }}</p>

    {{-- Quest List --}}
    <div class="space-y-4">
        @foreach($quests as $index => $quest)
            <div class="pixel-card {{ !$quest->is_unlocked ? 'pixel-card-locked' : '' }} p-6">
                <div class="flex items-center gap-4">
                    {{-- Quest Number / Lock --}}
                    <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center text-3xl
                        {{ !$quest->is_unlocked ? '' : ($quest->progress && $quest->progress->is_completed ? '' : '') }}">
                        @if(!$quest->is_unlocked)
                            🔒
                        @elseif($quest->progress && $quest->progress->is_completed)
                            ✅
                        @else
                            ⚔️
                        @endif
                    </div>

                    {{-- Quest Info --}}
                    <div class="flex-1">
                        <h3 class="font-pixel text-[11px] text-pixel-text mb-1">
                            QUEST {{ $index + 1 }}: {{ $quest->title }}
                        </h3>
                        @if($quest->description)
                            <p class="font-pixel-body text-lg text-pixel-text-muted">{{ Str::limit($quest->description, 100) }}</p>
                        @endif

                        <div class="flex items-center gap-4 mt-2">
                            <span class="font-pixel text-[9px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>

                            @if($quest->progress && $quest->progress->is_completed)
                                <span class="font-pixel text-[9px] text-pixel-green">
                                    ✓ SCORE: {{ $quest->progress->score }}/{{ $quest->progress->total_questions }}
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
@endsection
