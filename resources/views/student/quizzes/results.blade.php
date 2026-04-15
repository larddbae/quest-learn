@extends('layouts.student')

@section('title', 'Quest Complete!')

@section('main')
<div class="max-w-3xl mx-auto">
    {{-- Results Header --}}
    <div class="pixel-box p-8 mb-6 text-center">
        <div class="text-6xl mb-4 animate-float">
            @if($score === $progress->total_questions)
                🏆
            @elseif($score > $progress->total_questions / 2)
                ⭐
            @else
                💪
            @endif
        </div>
        <h1 class="font-pixel text-lg text-pixel-gold mb-3">QUEST COMPLETE!</h1>
        <p class="font-pixel text-[10px] text-pixel-text mb-4">{{ $quest->title }}</p>

        <div class="grid grid-cols-3 gap-4 max-w-sm mx-auto">
            <div class="pixel-box-light p-3 text-center">
                <p class="font-pixel text-lg {{ $score === $progress->total_questions ? 'text-pixel-gold' : 'text-pixel-text' }}">
                    {{ $score }}/{{ $progress->total_questions }}
                </p>
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">SCORE</p>
            </div>
            <div class="pixel-box-light p-3 text-center">
                <p class="font-pixel text-lg text-pixel-green">+{{ $quest->xp_reward }}</p>
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">XP EARNED</p>
            </div>
            <div class="pixel-box-light p-3 text-center">
                <p class="font-pixel text-lg text-pixel-cyan">{{ round(($score / $progress->total_questions) * 100) }}%</p>
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">ACCURACY</p>
            </div>
        </div>
    </div>

    {{-- Answer Review --}}
    <h2 class="font-pixel text-sm text-pixel-gold mb-4">📋 ANSWER REVIEW</h2>

    @foreach($results as $rIndex => $result)
        <div class="pixel-box p-6 mb-4">
            <h3 class="font-pixel text-[10px] {{ $result['is_correct'] ? 'text-pixel-green' : 'text-pixel-red' }} mb-3">
                {{ $result['is_correct'] ? '✅ CORRECT' : '❌ WRONG' }} — Q{{ $rIndex + 1 }}
            </h3>
            <p class="font-pixel-body text-xl text-pixel-text mb-4">{{ $result['quiz']->question }}</p>

            <div class="space-y-2">
                @foreach(['a', 'b', 'c', 'd'] as $option)
                    <div class="p-3 border-2
                        {{ $option === $result['quiz']->correct_answer ? 'quiz-option-correct border-green-500' : '' }}
                        {{ $option === $result['user_answer'] && !$result['is_correct'] ? 'quiz-option-wrong border-red-500' : '' }}
                        {{ $option !== $result['quiz']->correct_answer && $option !== $result['user_answer'] ? 'border-white/10' : '' }}
                    ">
                        <span class="font-pixel text-[9px] text-pixel-gold mr-2">{{ strtoupper($option) }}.</span>
                        <span class="font-pixel-body text-lg text-pixel-text">{{ $result['quiz']->{'option_' . $option} }}</span>

                        @if($option === $result['quiz']->correct_answer)
                            <span class="font-pixel text-[8px] text-pixel-green ml-2">✓ CORRECT</span>
                        @elseif($option === $result['user_answer'] && !$result['is_correct'])
                            <span class="font-pixel text-[8px] text-pixel-red ml-2">✗ YOUR ANSWER</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Navigation --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
        <a href="{{ route('student.quests.index', $quest->subject_id) }}" class="pixel-btn pixel-btn-blue text-center">
            ◀ QUEST BOARD
        </a>
        <a href="{{ route('student.dashboard') }}" class="pixel-btn pixel-btn-gold text-center">
            🏠 DASHBOARD
        </a>
    </div>
</div>
@endsection
