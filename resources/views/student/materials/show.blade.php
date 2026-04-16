@extends('layouts.student')

@section('title', $material->title . ' — Learning Room')

@section('main')
<div class="max-w-4xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.quests.index', $quest->subject_id) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors mb-4 uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            {{ $quest->subject->name }}
        </a>
    </div>

    {{-- Material Header & Content wrapped in one large pixel card --}}
    <x-pixel-card variant="low" padding="xl" class="mb-10 text-on-surface">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6 border-b-4 border-outline-variant pb-8 mb-8">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                    <h1 class="font-headline text-2xl text-primary-container uppercase leading-tight">{{ $material->title }}</h1>
                </div>
                <div class="flex flex-wrap items-center gap-4 mt-4">
                    <div class="bg-surface-container-high border-2 border-black px-3 py-1.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-surface-variant text-sm">explore</span>
                        <p class="font-headline text-[0.6rem] text-on-surface-variant uppercase">Quest: {{ $quest->title }}</p>
                    </div>
                    <div class="bg-surface-container-high border-2 border-black px-3 py-1.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        <p class="font-headline text-[0.6rem] text-primary-container uppercase">{{ $quest->xp_reward }} XP Reward</p>
                    </div>
                </div>
            </div>

            {{-- Bookmark Form --}}
            <form method="POST" action="{{ route('student.materials.bookmark', $material->id) }}" class="flex-shrink-0">
                @csrf
                <x-pixel-button variant="{{ $isBookmarked ? 'gold' : 'ghost' }}" type="submit" size="sm" icon="{{ $isBookmarked ? 'bookmark_added' : 'bookmark_add' }}">
                    {{ $isBookmarked ? 'SAVED_TO_INVENTORY' : 'SAVE_TO_INVENTORY' }}
                </x-pixel-button>
            </form>
        </div>

        {{-- Video Section --}}
        @if($material->video_url)
            <div class="mb-10 p-2 bg-surface-container-lowest border-4 border-black">
                <div class="aspect-video relative bg-black flex items-center justify-center group overflow-hidden">
                    @php
                        $videoId = '';
                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $material->video_url, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                class="absolute top-0 left-0 w-full h-full border-0"
                                allowfullscreen></iframe>
                    @else
                        <span class="material-symbols-outlined text-surface-variant text-8xl absolute z-0 opacity-20">movie</span>
                        <div class="relative z-10">
                            <x-pixel-button variant="blue" href="{{ $material->video_url }}" target="_blank" icon="open_in_new">
                                WATCH EXTERNAL VIDEO
                            </x-pixel-button>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Written Material Content --}}
        <div class="font-body text-xl md:text-2xl leading-relaxed text-on-surface prose prose-invert prose-p:mb-6 prose-headings:font-headline prose-headings:text-primary-container max-w-none">
            {!! nl2br(e($material->content)) !!}
        </div>
    </x-pixel-card>

    {{-- Call to Action: Proceed to Quiz --}}
    @if($quizCount > 0)
        <div class="flex flex-col items-center justify-center p-8 bg-surface-container-low border-4 border-black shadow-[8px_8px_0_0_#000] relative overflow-hidden">
            {{-- Decorative Grid Bg --}}
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#ffd700 1px, transparent 1px); background-size: 16px 16px;"></div>
            
            <span class="material-symbols-outlined text-primary-container text-6xl mb-4 relative z-10 animate-bounce" style="font-variation-settings: 'FILL' 1;">swords</span>
            <h3 class="font-headline text-lg text-on-surface uppercase mb-3 relative z-10">READY FOR BATTLE?</h3>
            <p class="font-body text-xl text-on-surface-variant mb-8 text-center max-w-lg relative z-10">
                Answer {{ $quizCount }} {{ Str::plural('question', $quizCount) }} to defeat this boss, conquer the quest, and earn your {{ $quest->xp_reward }} XP reward!
            </p>
            
            <div class="relative z-10 w-full max-w-xs sm:max-w-md">
                <x-pixel-button variant="green" size="lg" :full="true" href="{{ route('student.quizzes.show', $quest) }}" icon="crisis_alert">
                    PROCEED_TO_BATTLE
                </x-pixel-button>
            </div>
        </div>
    @else
        <div class="p-6 bg-surface-container-low border-4 border-black text-center flex flex-col items-center">
            <span class="material-symbols-outlined text-surface-variant text-4xl mb-2">check_circle</span>
            <p class="font-headline text-[0.6rem] text-surface-variant uppercase tracking-widest">No quiz battle for this quest. Exploration complete.</p>
        </div>
    @endif
</div>
@endsection
