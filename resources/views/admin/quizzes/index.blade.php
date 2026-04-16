@extends('layouts.admin')

@section('title', 'Quizzes — ' . $quest->title)

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.quests.index', $quest->subject) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            {{ $quest->subject->name }} > {{ $quest->title }}
        </a>
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-error text-4xl animate-pulse" style="font-variation-settings: 'FILL' 1;">swords</span>
            <div>
                <h1 class="font-headline text-2xl text-error uppercase">ENEMY BESTIARY</h1>
                <p class="font-body text-lg text-on-surface-variant mt-1">Manage quiz battles for {{ $quest->title }}</p>
            </div>
        </div>
        <x-pixel-button variant="error" size="md" href="{{ route('admin.quizzes.create', $quest) }}" icon="crisis_alert">
            DEPLOY NEW ENEMY
        </x-pixel-button>
    </div>

    {{-- Quiz List --}}
    @forelse($quizzes as $qIndex => $quiz)
        <x-pixel-card variant="low" padding="lg" class="mb-6">
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- Question Column --}}
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-4 pb-4 border-b-4 border-black">
                        <div class="bg-error text-white font-headline text-[0.6rem] uppercase px-3 py-1 border-2 border-black flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">skull</span> ENEMY {{ $qIndex + 1 }}
                        </div>
                        <div class="flex gap-2">
                            <x-pixel-button variant="gold" size="sm" href="{{ route('admin.quizzes.edit', [$quest, $quiz]) }}" icon="edit">
                                EDIT
                            </x-pixel-button>
                            <form method="POST" action="{{ route('admin.quizzes.destroy', [$quest, $quiz]) }}" class="inline"
                                  onsubmit="return confirm('WARNING: Erase this enemy pattern?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-surface-container-lowest border-4 border-error text-error hover:bg-error hover:text-white p-2 flex items-center justify-center transition-colors shadow-[4px_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 active:translate-x-1" title="DESTROY">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <p class="font-body text-2xl text-on-surface mb-4 leading-snug">{{ $quiz->question }}</p>
                </div>

                {{-- Answers Column --}}
                <div class="w-full md:w-[45%] flex-shrink-0 bg-surface-container-lowest border-4 border-black p-4 space-y-3">
                    <p class="font-headline text-[0.55rem] text-surface-variant uppercase mb-2">TARGET ACTIONS PARAMETERS:</p>
                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                        @php
                            $isCorrect = $opt === $quiz->correct_answer;
                            $bgClass = $isCorrect ? 'bg-secondary-container text-black border-black shadow-[4px_4px_0_0_#000]' : 'bg-surface-container border-surface-variant text-surface-variant';
                            $iconColor = $isCorrect ? 'text-black' : 'text-surface-variant';
                        @endphp
                        <div class="flex items-center gap-3 p-3 border-4 {{ $bgClass }} transition-colors">
                            <div class="w-8 h-8 shrink-0 bg-background border-2 border-black flex items-center justify-center font-headline text-[0.7rem] uppercase">
                                {{ $opt }}
                            </div>
                            <span class="font-body text-xl tracking-wide flex-1">{{ $quiz->{'option_' . $opt} }}</span>
                            @if($isCorrect)
                                <span class="material-symbols-outlined text-black animate-pulse" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </x-pixel-card>
    @empty
        <x-pixel-card variant="low" padding="xl" class="text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-error/5 dithered-bg pointer-events-none opacity-50"></div>
            <span class="material-symbols-outlined text-error text-7xl mb-4 relative z-10" style="font-variation-settings: 'FILL' 1;">crisis_alert</span>
            <p class="font-headline text-lg text-error mb-2 uppercase relative z-10">NO ENEMIES DETECTED</p>
            <p class="font-body text-xl text-on-surface-variant mb-6 mx-auto max-w-md relative z-10">The battle arena for this quest is currently empty.</p>
            <div class="relative z-10 inline-block">
                <x-pixel-button variant="error" href="{{ route('admin.quizzes.create', $quest) }}" icon="add">
                    DEPLOY FIRST ENEMY
                </x-pixel-button>
            </div>
        </x-pixel-card>
    @endforelse
</div>
@endsection
