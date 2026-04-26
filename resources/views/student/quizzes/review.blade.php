@extends('layouts.student')

@section('title', 'Review: ' . $quest->title)

@section('main')
<div class="max-w-4xl mx-auto pb-16">
    {{-- Review Header --}}
    <div class="flex flex-col items-center justify-center text-center mb-10">
        <span class="material-symbols-outlined text-secondary-container text-6xl mb-4" style="font-variation-settings: 'FILL' 1;">history</span>
        <h1 class="font-headline text-3xl text-secondary-container uppercase tracking-widest bg-secondary-container/10 px-8 py-2 border-y-4 border-secondary-container pixel-glow mb-4">
            BATTLE RECORD
        </h1>
        <div class="flex items-center gap-4 text-on-surface-variant font-headline text-[0.6rem] uppercase">
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-primary-container">
                QUEST: {{ $quest->title }}
            </span>
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-secondary-container">
                SCORE: {{ $progress->score }}/{{ $progress->total_questions }}
            </span>
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-primary-container">
                🌟 {{ $quest->xp_reward }} XP EARNED
            </span>
        </div>
    </div>

    {{-- Review Container --}}
    <div class="space-y-12">
        @if(empty($results))
            <x-pixel-card variant="low" padding="xl" class="text-center">
                <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">folder_off</span>
                <h3 class="font-headline text-lg text-surface-variant uppercase mb-2">ARCHIVE CORRUPTED</h3>
                <p class="font-body text-xl text-on-surface-variant">No answer data is available for this older battle record.</p>
                <div class="mt-6">
                    <x-pixel-button variant="ghost" size="md" href="{{ route('student.quests.index', $quest->subject_id) }}" icon="arrow_back">
                        RETURN
                    </x-pixel-button>
                </div>
            </x-pixel-card>
        @else
            @foreach($results as $rIndex => $result)
                @php
                    $isCorrect = $result['is_correct'];
                    $quiz = $result['quiz'];
                    $userAnswer = $result['user_answer'];
                    
                    $headerColor = $isCorrect ? 'bg-secondary-container text-black' : 'bg-error text-white';
                    $borderColor = $isCorrect ? 'border-secondary-container' : 'border-error';
                    $icon = $isCorrect ? 'check_circle' : 'cancel';
                @endphp

                <div class="relative">
                    {{-- Status Badge --}}
                    <div class="absolute -top-4 left-6 z-10 {{ $headerColor }} border-4 border-black px-4 py-1 flex items-center gap-2 shadow-[2px_2px_0_0_#000]">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
                        <span class="font-headline text-[0.6rem] uppercase">
                            Q{{ $rIndex + 1 }} - {{ $isCorrect ? 'SUCCESS' : 'FAILED' }}
                        </span>
                    </div>

                    {{-- Question Container --}}
                    <div class="border-4 border-black bg-surface-container-lowest flex flex-col md:flex-row h-auto shadow-[8px_8px_0_0_#000]">
                        
                        {{-- LEFT: The Question --}}
                        <div class="flex-1 bg-surface-container-high border-b-4 md:border-b-0 md:border-r-4 border-black p-8 flex flex-col justify-center relative">
                            <p class="font-body text-2xl md:text-3xl text-on-surface leading-snug mt-4">
                                {{ $quiz->question }}
                            </p>
                        </div>

                        {{-- RIGHT: The Answers --}}
                        <div class="w-full md:w-[45%] bg-[#1A1A3E] p-6 flex flex-col justify-center">
                            <div class="space-y-3 mt-4">
                                @foreach(['a', 'b', 'c', 'd'] as $option)
                                    @php
                                        $isCorrectOption = ($option === $quiz->correct_answer);
                                        $isSelectedOption = ($option === $userAnswer);
                                        
                                        // Styling logic
                                        if ($isCorrectOption) {
                                            $boxClass = 'bg-secondary-container/20 border-secondary-container text-on-surface';
                                            $letterClass = 'bg-secondary-container text-black';
                                        } elseif ($isSelectedOption && !$isCorrectOption) {
                                            $boxClass = 'bg-error/20 border-error text-on-surface opacity-80';
                                            $letterClass = 'bg-error text-white';
                                        } else {
                                            $boxClass = 'bg-surface-container-lowest border-surface-variant text-surface-variant opacity-50';
                                            $letterClass = 'bg-background text-surface-variant';
                                        }
                                    @endphp

                                    <div class="w-full border-4 p-3 flex items-center gap-4 {{ $boxClass }}">
                                        {{-- Option Letter --}}
                                        <div class="w-8 h-8 flex-shrink-0 border-2 border-black flex items-center justify-center font-headline text-[0.7rem] uppercase {{ $letterClass }}">
                                            {{ $option }}
                                        </div>
                                        
                                        {{-- Answer Text --}}
                                        <span class="font-body text-xl flex-1 leading-tight">
                                            {{ $quiz->{'option_' . $option} }}
                                        </span>

                                        {{-- Feedback Icons --}}
                                        @if($isCorrectOption)
                                            <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
                                        @elseif($isSelectedOption && !$isCorrectOption)
                                            <span class="material-symbols-outlined text-error text-2xl" style="font-variation-settings: 'FILL' 1;">close</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Navigation Actions --}}
            <div class="pt-8 text-center border-t-4 border-outline-variant mt-16 max-w-lg mx-auto flex gap-4 justify-center">
                <x-pixel-button variant="blue" size="lg" href="{{ route('student.quests.index', $quest->subject_id) }}" icon="list">
                    QUEST_BOARD
                </x-pixel-button>
                <x-pixel-button variant="gold" size="lg" href="{{ route('student.dashboard') }}" icon="home">
                    DASHBOARD
                </x-pixel-button>
            </div>
        @endif
    </div>
</div>
@endsection
