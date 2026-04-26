@extends('layouts.student')

@section('title', 'Guild Hall — Select Your Guild')

@section('main')
<div class="max-w-6xl mx-auto pb-12">

    {{-- ============================================
         HERO HEADER
         ============================================ --}}
    <div class="text-center mb-10">
        <div class="inline-block p-4 bg-surface-container-high border-4 border-black mb-4 pixel-shadow">
            <span class="material-symbols-outlined text-primary-container text-6xl" style="font-variation-settings: 'FILL' 1;">fort</span>
        </div>
        <h1 class="font-headline text-xl md:text-2xl text-primary-container pixel-glow tracking-widest leading-relaxed">
            [ GUILD HALL ]
        </h1>
        <p class="font-body text-2xl text-on-surface-variant mt-3 max-w-lg mx-auto">
            Choose your guild to begin today's adventure, Adventurer.
        </p>
    </div>

    {{-- ============================================
         SEARCH BAR
         ============================================ --}}
    <div class="mb-8">
        <form method="GET" action="{{ route('student.guild-select') }}" class="flex gap-3" id="guild-search-form">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-surface-variant text-xl">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full bg-surface-container-lowest border-4 border-black pl-12 pr-4 py-3 text-on-surface font-body text-xl focus:ring-0 focus:border-primary-container outline-none placeholder:text-surface-variant"
                       placeholder="Search guilds by name or Game Master..."
                       id="guild-search-input">
            </div>
            <x-pixel-button variant="gold" type="submit" icon="search" size="sm">
                SCAN
            </x-pixel-button>
            @if(request('search'))
                <x-pixel-button variant="ghost" href="{{ route('student.guild-select') }}" icon="close" size="sm">
                    CLEAR
                </x-pixel-button>
            @endif
        </form>
    </div>

    {{-- ============================================
         SECTION 1: MY GUILDS (Grid)
         ============================================ --}}
    @if($classrooms->count() > 0)
        <div class="mb-12">
            {{-- Section Label --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">groups</span>
                <h2 class="font-headline text-[0.7rem] text-secondary-container uppercase tracking-wider">
                    YOUR GUILDS [{{ $classrooms->count() }}]
                </h2>
                <div class="flex-1 border-b-2 border-outline-variant"></div>
            </div>

            {{-- Guild Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($classrooms as $classroom)
                    <x-pixel-card variant="low" padding="none" hover>
                        <div>
                            {{-- Guild Banner / Header Strip --}}
                            <div class="bg-surface-container-high border-b-4 border-black px-4 py-3 flex items-center gap-3 flex-wrap">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 border-3 border-black bg-background flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary-container text-xl sm:text-2xl" style="font-variation-settings: 'FILL' 1;">fort</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-headline text-[0.6rem] text-primary-container uppercase truncate leading-relaxed">
                                        {{ $classroom->name }}
                                    </h3>
                                    <p class="font-body text-lg text-on-surface-variant truncate leading-tight">
                                        {{ $classroom->join_code }}
                                    </p>
                                </div>
                                {{-- Inline Badges --}}
                                <div class="flex flex-wrap items-center gap-1 flex-shrink-0">
                                    @if(session('active_classroom_id') == $classroom->id)
                                        <span class="inline-flex items-center gap-1 bg-secondary-container border-2 border-black px-2 py-0.5">
                                            <span class="material-symbols-outlined text-black text-xs" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                            <span class="font-headline text-[6px] text-black uppercase">ACTIVE</span>
                                        </span>
                                    @endif
                                    @if($classroom->visibility === 'public')
                                        <span class="inline-flex items-center gap-1 bg-secondary-container/20 border-2 border-secondary-container px-2 py-0.5">
                                            <span class="material-symbols-outlined text-secondary-container text-[10px]" style="font-variation-settings: 'FILL' 1;">public</span>
                                            <span class="font-headline text-[5px] text-secondary-container uppercase">PUBLIC</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-error-container/20 border-2 border-error px-2 py-0.5">
                                            <span class="material-symbols-outlined text-error text-[10px]" style="font-variation-settings: 'FILL' 1;">lock</span>
                                            <span class="font-headline text-[5px] text-error uppercase">PRIVATE</span>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Guild Details --}}
                            <div class="px-5 py-4 space-y-3">
                                {{-- Game Master --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-tertiary-fixed-dim text-lg" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">GAME MASTER</span>
                                        <span class="font-body text-lg text-on-surface truncate block">{{ $classroom->teacher->name ?? 'Unknown' }}</span>
                                    </div>
                                </div>

                                {{-- Member Count --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary-container text-lg" style="font-variation-settings: 'FILL' 1;">group</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">MEMBERS</span>
                                        <span class="font-body text-lg text-on-surface">{{ $classroom->users_count ?? $classroom->users()->count() }} Adventurers</span>
                                    </div>
                                </div>

                                {{-- Subjects Count --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">SUBJECTS</span>
                                        <span class="font-body text-lg text-on-surface">{{ $classroom->subjects_count ?? $classroom->subjects()->count() }} Available</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Top-Right Badges Removed (Moved to header strip) --}}

                            {{-- Enter Guild Button --}}
                            <div class="px-5 pb-5 pt-2">
                                <form method="POST" action="{{ route('student.guild-select.set') }}">
                                    @csrf
                                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                    @if(session('active_classroom_id') == $classroom->id)
                                        <x-pixel-button variant="green" type="submit" :full="true" icon="login" size="sm">
                                            CONTINUE QUEST
                                        </x-pixel-button>
                                    @else
                                        <x-pixel-button variant="gold" type="submit" :full="true" icon="login" size="sm">
                                            ENTER GUILD
                                        </x-pixel-button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </x-pixel-card>
                @endforeach
            </div>
        </div>
    @else
        {{-- ============================================
             EMPTY STATE: No Guilds
             ============================================ --}}
        <div class="mb-12">
            <x-pixel-card variant="low" padding="lg">
                <div class="flex flex-col items-center text-center py-8">
                    {{-- Character Illustration --}}
                    <div class="w-24 h-24 border-4 border-black bg-surface-container-high flex items-center justify-center mb-6 pixel-shadow">
                        <span class="material-symbols-outlined text-surface-variant text-6xl animate-float" style="font-variation-settings: 'FILL' 1;">person_off</span>
                    </div>

                    <h2 class="font-headline text-[0.8rem] text-primary-container uppercase tracking-wider mb-3">
                        LONE WOLF DETECTED
                    </h2>
                    <p class="font-body text-2xl text-on-surface-variant max-w-md mb-2">
                        You haven't joined any guild yet. Every great adventurer needs a party!
                    </p>
                    <p class="font-body text-xl text-surface-variant max-w-sm">
                        Enter a Join Code below, or browse Public Guilds to get started.
                    </p>

                    {{-- Decorative Divider --}}
                    <div class="flex items-center gap-4 my-6 w-full max-w-xs">
                        <div class="flex-1 border-b-2 border-outline-variant"></div>
                        <span class="material-symbols-outlined text-outline text-lg">arrow_downward</span>
                        <div class="flex-1 border-b-2 border-outline-variant"></div>
                    </div>
                </div>
            </x-pixel-card>
        </div>
    @endif

    {{-- ============================================
         SECTION 2: RECOMMENDED PUBLIC GUILDS
         ============================================ --}}
    @if($publicGuilds->count() > 0)
        <div class="mb-12">
            {{-- Section Label --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-tertiary-fixed-dim text-2xl" style="font-variation-settings: 'FILL' 1;">explore</span>
                <h2 class="font-headline text-[0.7rem] text-tertiary-fixed-dim uppercase tracking-wider">
                    RECOMMENDED PUBLIC GUILDS [{{ $publicGuilds->count() }}]
                </h2>
                <div class="flex-1 border-b-2 border-outline-variant"></div>
            </div>

            {{-- Public Guild Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($publicGuilds as $guild)
                    <x-pixel-card variant="high" padding="none" hover>
                        <div>
                            {{-- Guild Banner / Header Strip --}}
                            <div class="bg-surface-container-highest border-b-4 border-black px-4 py-3 flex items-center gap-3 flex-wrap">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 border-3 border-black bg-background flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-tertiary-fixed-dim text-xl sm:text-2xl" style="font-variation-settings: 'FILL' 1;">public</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-headline text-[0.6rem] text-tertiary-fixed-dim uppercase truncate leading-relaxed">
                                        {{ $guild->name }}
                                    </h3>
                                    <p class="font-body text-lg text-on-surface-variant truncate leading-tight">
                                        Open Guild
                                    </p>
                                </div>
                                {{-- Public Badge (inline, responsive) --}}
                                <span class="inline-flex items-center gap-1 bg-secondary-container border-2 border-black px-2 py-0.5 flex-shrink-0">
                                    <span class="material-symbols-outlined text-black text-xs" style="font-variation-settings: 'FILL' 1;">public</span>
                                    <span class="font-headline text-[6px] text-black uppercase">PUBLIC</span>
                                </span>
                            </div>

                            {{-- Guild Details --}}
                            <div class="px-5 py-4 space-y-3">
                                {{-- Game Master --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-tertiary-fixed-dim text-lg" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">GAME MASTER</span>
                                        <span class="font-body text-lg text-on-surface truncate block">{{ $guild->teacher->name ?? 'Unknown' }}</span>
                                    </div>
                                </div>

                                {{-- Member Count --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary-container text-lg" style="font-variation-settings: 'FILL' 1;">group</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">MEMBERS</span>
                                        <span class="font-body text-lg text-on-surface">{{ $guild->users_count }} Adventurers</span>
                                    </div>
                                </div>

                                {{-- Subjects Count --}}
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                                    <div class="flex-1 min-w-0">
                                        <span class="font-headline text-[7px] text-surface-variant uppercase block">SUBJECTS</span>
                                        <span class="font-body text-lg text-on-surface">{{ $guild->subjects_count }} Available</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Public Badge Removed (Moved to header strip) --}}

                            {{-- Join Button --}}
                            <div class="px-5 pb-5 pt-2">
                                <form method="POST" action="{{ route('student.guild-select.join-public') }}">
                                    @csrf
                                    <input type="hidden" name="classroom_id" value="{{ $guild->id }}">
                                    <x-pixel-button variant="blue" type="submit" :full="true" icon="add" size="sm">
                                        JOIN NOW
                                    </x-pixel-button>
                                </form>
                            </div>
                        </div>
                    </x-pixel-card>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ============================================
         SECTION 3: JOIN BY CODE (Private Guild)
         ============================================ --}}
    <div class="mb-10">
        {{-- Section Label --}}
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">vpn_key</span>
            <h2 class="font-headline text-[0.7rem] text-primary-container uppercase tracking-wider">
                JOIN BY CODE (PRIVATE GUILDS)
            </h2>
            <div class="flex-1 border-b-2 border-outline-variant"></div>
        </div>

        <x-pixel-card variant="high" padding="lg">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                {{-- Left: Icon + Description --}}
                <div class="flex-1 text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start gap-4 mb-4">
                        <div class="w-14 h-14 border-4 border-black bg-background flex items-center justify-center pixel-shadow">
                            <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">vpn_key</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-[0.6rem] text-primary-container uppercase">ENTER JOIN CODE</h3>
                            <p class="font-body text-lg text-on-surface-variant">Get a 6-character code from your Game Master</p>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center gap-6 mt-6">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check</span>
                            <span class="font-body text-lg text-on-surface-variant">Instant access</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check</span>
                            <span class="font-body text-lg text-on-surface-variant">Join multiple guilds</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check</span>
                            <span class="font-body text-lg text-on-surface-variant">Switch anytime</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Join Form --}}
                <div class="w-full lg:w-auto lg:min-w-[320px]">
                    <form method="POST" action="{{ route('student.join-class.submit') }}" class="flex flex-col items-center gap-4">
                        @csrf
                        <input type="text" name="join_code" value="{{ old('join_code') }}" required
                               maxlength="6"
                               class="w-full bg-surface-container-lowest border-4 border-black p-4 text-center text-on-surface font-headline text-xl md:text-2xl tracking-[0.4em] uppercase focus:ring-0 focus:border-primary-container outline-none placeholder:text-surface-variant placeholder:tracking-[0.2em] placeholder:text-base shadow-[2px_2px_0_0_rgba(0,0,0,1)]"
                               placeholder="ENTER CODE"
                               id="guild-join-code-input">
                        <x-pixel-button variant="gold" type="submit" :full="true" icon="add">
                            JOIN GUILD
                        </x-pixel-button>
                    </form>
                </div>
            </div>
        </x-pixel-card>
    </div>

    {{-- ============================================
         TIPS / INFO BAR
         ============================================ --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-surface-container-low border-4 border-black p-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-primary-container flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-on-primary-container text-lg">lightbulb</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline text-[7px] text-primary-container">TIP</span>
                <span class="font-body text-sm text-on-surface-variant">You can join multiple guilds and switch freely.</span>
            </div>
        </div>
        <div class="bg-surface-container-low border-4 border-black p-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-secondary-container flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-on-secondary-container text-lg">shield</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline text-[7px] text-secondary-container">SECURITY</span>
                <span class="font-body text-sm text-on-surface-variant">Encrypted guild connection active.</span>
            </div>
        </div>
        <div class="bg-surface-container-low border-4 border-black p-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-tertiary-fixed-dim flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-on-tertiary-fixed-variant text-lg">help</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline text-[7px] text-tertiary-fixed-dim">HELP</span>
                <span class="font-body text-sm text-on-surface-variant">Contact your teacher for a join code.</span>
            </div>
        </div>
    </div>
</div>
@endsection
