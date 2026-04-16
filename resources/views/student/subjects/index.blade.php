@extends('layouts.student')

@section('title', 'Subject Hub')

@section('main')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
        <h1 class="font-headline text-xl text-on-surface uppercase tracking-wider">SUBJECT HUB</h1>
    </div>

    @if($subjects->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-8xl mb-6">inventory_2</span>
            <h2 class="font-headline text-lg text-primary-container mb-2 uppercase">NO SUBJECTS YET</h2>
            <p class="font-body text-xl text-on-surface-variant">Your Game Master hasn't added any subjects to this guild. Check back later!</p>
        </x-pixel-card>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @php
                $subjectIcons = [
                    'science' => 'science',
                    'math' => 'calculate',
                    'history' => 'history_edu',
                    'english' => 'local_library',
                ];
            @endphp
            
            @foreach($subjects as $subject)
                @php
                    $icon = $subjectIcons[strtolower($subject->name)] ?? 'explore';
                @endphp
                <a href="{{ route('student.quests.index', $subject) }}" class="block group">
                    <x-pixel-card variant="low" padding="lg" hover class="h-full border-b-8 group-active:border-b-4 group-active:translate-y-1 transition-all">
                        <div class="flex flex-col items-center text-center h-full">
                            {{-- Icon Portal --}}
                            <div class="relative w-24 h-24 mb-6">
                                <div class="absolute inset-0 bg-surface-container border-4 border-black group-hover:bg-primary-container transition-colors shadow-[4px_4px_0_0_#000]"></div>
                                <div class="absolute inset-2 bg-background border-2 border-black flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary-container text-5xl group-hover:text-background transition-colors" style="font-variation-settings: 'FILL' 1;">
                                        {{ $icon }}
                                    </span>
                                </div>
                            </div>

                            {{-- Subject Info --}}
                            <h3 class="font-headline text-[0.8rem] text-primary-container uppercase mb-3 flex-grow">{{ $subject->name }}</h3>
                            
                            @if($subject->description)
                                <p class="font-body text-lg text-on-surface-variant mb-6 line-clamp-2">
                                    {{ $subject->description }}
                                </p>
                            @endif

                            {{-- Quest Count Badge --}}
                            <div class="bg-surface-container border-2 border-black px-4 py-2 mt-auto w-full group-hover:border-primary-container transition-colors">
                                <span class="font-body text-secondary-container text-lg uppercase flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm">map</span>
                                    {{ $subject->quests_count }} {{ Str::plural('QUEST', $subject->quests_count) }}
                                </span>
                            </div>
                        </div>
                    </x-pixel-card>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
