@extends('layouts.student')

@section('title', $subject->name . ' — Quest Board')

@section('main')
<div class="max-w-4xl mx-auto pb-12">
    {{-- Breadcrumb & Header --}}
    <div class="mb-8 relative">
        <a href="{{ route('student.subjects.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors mb-4 uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            SUBJECTS
        </a>
        
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary-container text-5xl" style="font-variation-settings: 'FILL' 1;">swords</span>
            <div>
                <h1 class="font-headline text-2xl text-primary-container uppercase">{{ $subject->name }}</h1>
                <p class="font-body text-xl text-on-surface-variant mt-2">{{ $subject->description }}</p>
            </div>
        </div>
    </div>

    {{-- Quest List --}}
    <div class="space-y-6 relative">
        {{-- Quest Path Line (Decorative) --}}
        <div class="hidden sm:block absolute left-[3.25rem] top-8 bottom-8 w-1 bg-surface-container -z-10"></div>

        @foreach($quests as $index => $quest)
            @php
                $isCompleted = $quest->progress && $quest->progress->is_completed;
                $isUnlocked = $quest->is_unlocked;
                
                // Styling based on state
                $cardVariant = $isUnlocked ? 'low' : 'lowest';
                $icon = $isCompleted ? 'check_circle' : ($isUnlocked ? 'explore' : 'lock');
                $iconColor = $isCompleted ? 'text-secondary-container' : ($isUnlocked ? 'text-primary-container' : 'text-surface-variant');
                $borderClass = $isUnlocked ? 'border-primary-container' : 'border-surface-variant';
                $bgBox = $isUnlocked ? 'bg-surface-container-high' : 'bg-background';
            @endphp

            <x-pixel-card variant="{{ $cardVariant }}" padding="none" class="overflow-hidden transition-all {{ $isUnlocked ? 'hover:-translate-y-1 hover:shadow-[4px_8px_0_0_#000]' : 'opacity-70 grayscale' }}">
                <div class="flex flex-col sm:flex-row p-6 items-start sm:items-center gap-6 relative">
                    
                    {{-- Quest Number & Icon Hub --}}
                    <div class="relative flex-shrink-0 flex items-center justify-center">
                        <div class="w-16 h-16 border-4 border-black {{ $bgBox }} rounded-sm flex items-center justify-center z-10 z-index shadow-[2px_2px_0_0_#000]">
                             <span class="material-symbols-outlined text-4xl {{ $iconColor }}" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
                        </div>
                        {{-- Level tag --}}
                        <div class="absolute -bottom-3 -right-2 bg-black text-white border-2 border-primary-container px-2 py-1 z-20">
                            <span class="font-headline text-[0.45rem]">Q{{ $index + 1 }}</span>
                        </div>
                    </div>

                    {{-- Quest Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-headline text-sm mb-2 {{ $isUnlocked ? 'text-on-surface' : 'text-surface-variant' }} uppercase">
                            {{ $quest->title }}
                        </h3>
                        
                        @if($quest->description)
                            <p class="font-body text-lg mb-4 {{ $isUnlocked ? 'text-on-surface-variant' : 'text-surface-variant' }}">
                                {{ Str::limit($quest->description, 100) }}
                            </p>
                        @endif

                        {{-- Reward & Status Tags --}}
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="bg-surface-container border-2 border-black px-2 py-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm {{ $isUnlocked ? 'text-primary-container' : 'text-surface-variant' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-headline text-[0.55rem] {{ $isUnlocked ? 'text-primary-container' : 'text-surface-variant' }}">{{ $quest->xp_reward }} XP</span>
                            </div>

                            @if($isCompleted)
                                <div class="bg-surface-container border-2 border-black px-2 py-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-secondary-container" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                                    <span class="font-headline text-[0.55rem] text-secondary-container">SCORE: {{ $quest->progress->score }}/{{ $quest->progress->total_questions }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex-shrink-0 w-full sm:w-auto mt-4 sm:mt-0 pt-4 sm:pt-0 border-t-2 sm:border-t-0 border-outline-variant flex justify-center">
                        @if(!$isUnlocked)
                            <div class="px-6 py-3 border-4 border-surface-variant bg-surface-container-lowest text-surface-variant font-headline text-[0.6rem] flex items-center gap-2">
                                <span class="material-symbols-outlined text-lg">lock</span> LOCKED
                            </div>
                        @elseif($isCompleted)
                            <x-pixel-button variant="blue" size="md" href="{{ route('student.quizzes.review', $quest) }}" icon="history">
                                REVIEW
                            </x-pixel-button>
                        @else
                            <x-pixel-button variant="gold" size="md" href="{{ route('student.materials.show', $quest) }}" icon="play_arrow" class="animate-pulse">
                                BEGIN_QUEST
                            </x-pixel-button>
                        @endif
                    </div>
                </div>
            </x-pixel-card>
        @endforeach
    </div>
</div>
@endsection
