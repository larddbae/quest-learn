@extends('layouts.student')

@section('title', 'Quiz Arena')

@section('main')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-pixel text-lg text-pixel-gold mb-2">⚔️ QUIZ ARENA</h1>
                <p class="font-pixel-body text-xl text-pixel-text-muted">
                    Test your knowledge! Complete quizzes to earn XP and level up.
                </p>
            </div>
            <div class="flex gap-3">
                <div class="pixel-box-light p-3 text-center">
                    <p class="font-pixel text-lg text-pixel-green">{{ $completedProgress->count() }}</p>
                    <p class="font-pixel text-[7px] text-pixel-text-muted mt-1">COMPLETED</p>
                </div>
                <div class="pixel-box-light p-3 text-center">
                    <p class="font-pixel text-lg text-pixel-cyan">
                        {{ $totalQuestions > 0 ? round(($totalScore / $totalQuestions) * 100) : 0 }}%
                    </p>
                    <p class="font-pixel text-[7px] text-pixel-text-muted mt-1">ACCURACY</p>
                </div>
                <div class="pixel-box-light p-3 text-center">
                    <p class="font-pixel text-lg text-pixel-gold">{{ $perfectCount }}</p>
                    <p class="font-pixel text-[7px] text-pixel-text-muted mt-1">PERFECT</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Available Quizzes --}}
    <h2 class="font-pixel text-sm text-pixel-green mb-4">🎯 AVAILABLE QUIZZES</h2>

    @if($availableQuests->isEmpty())
        <div class="pixel-box p-8 text-center mb-8">
            <div class="text-5xl mb-3">🎯</div>
            <p class="font-pixel text-[10px] text-pixel-text-muted mb-2">NO QUIZZES AVAILABLE</p>
            <p class="font-pixel-body text-lg text-pixel-text-muted">
                Read the materials first, then come back to take the quiz!
            </p>
            <a href="{{ route('student.learning-room') }}" class="pixel-btn pixel-btn-blue pixel-btn-sm mt-3 inline-block">
                📜 GO TO LEARNING ROOM
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($availableQuests as $quest)
                <div class="pixel-card p-5 animate-glow">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl animate-float">⚔️</div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-pixel text-[10px] text-pixel-gold mb-1 truncate">{{ $quest->title }}</h3>
                            <p class="font-pixel-body text-base text-pixel-text-muted">
                                {{ $quest->subject->name }}
                            </p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="font-pixel text-[8px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>
                                <span class="font-pixel text-[8px] text-pixel-cyan">
                                    📝 {{ $quest->material->quizzes->count() }} {{ Str::plural('Question', $quest->material->quizzes->count()) }}
                                </span>
                            </div>
                            <a href="{{ route('student.quizzes.show', $quest) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm mt-3 inline-block">
                                ⚔️ START QUIZ
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Quiz History --}}
    <h2 class="font-pixel text-sm text-pixel-cyan mb-4">📋 QUIZ HISTORY</h2>

    @if($completedProgress->isEmpty())
        <div class="pixel-box p-8 text-center">
            <div class="text-4xl mb-2">📋</div>
            <p class="font-pixel text-[9px] text-pixel-text-muted">No quiz history yet. Take your first quiz!</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($completedProgress as $progress)
                <div class="pixel-card p-5">
                    <div class="flex items-center gap-4">
                        <div class="text-3xl">
                            @if($progress->score === $progress->total_questions)
                                🏆
                            @elseif($progress->score > $progress->total_questions / 2)
                                ⭐
                            @else
                                💪
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-pixel text-[10px] text-pixel-text truncate">{{ $progress->quest->title }}</h3>
                            <p class="font-pixel-body text-base text-pixel-text-muted">
                                {{ $progress->quest->subject->name ?? '' }}
                            </p>
                        </div>
                        <div class="text-center">
                            <p class="font-pixel text-lg {{ $progress->score === $progress->total_questions ? 'text-pixel-gold' : 'text-pixel-text' }}">
                                {{ $progress->score }}/{{ $progress->total_questions }}
                            </p>
                            <p class="font-pixel text-[7px] text-pixel-text-muted mt-1">
                                {{ round(($progress->score / $progress->total_questions) * 100) }}%
                            </p>
                        </div>
                        <span class="font-pixel text-[9px] text-pixel-green">+{{ $progress->quest->xp_reward }}XP</span>
                        <span class="font-pixel-body text-base text-pixel-text-muted">
                            {{ $progress->completed_at?->diffForHumans() ?? '' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
