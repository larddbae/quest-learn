@extends('layouts.admin')

@section('title', $classroom->name . ' — Live Monitoring')

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.classrooms.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            RETURN TO GUILDS
        </a>
    </div>

    {{-- Live Monitor Header --}}
    <x-pixel-card variant="high" padding="lg" class="mb-10 text-on-surface">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-error text-5xl animate-pulse" style="font-variation-settings: 'FILL' 1;">monitor_heart</span>
                <div>
                    <h1 class="font-headline text-2xl text-primary-container uppercase">{{ $classroom->name }}</h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="font-headline text-[0.6rem] bg-black text-secondary-container px-2 py-1 border-2 border-secondary-container">LIVE_MONITOR_ACTIVE</span>
                        <span class="font-body text-xl text-on-surface-variant">{{ $students->count() }} Players Connected</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                {{-- Join Code Display --}}
                <div class="bg-background border-4 border-primary-container px-6 py-2 flex items-center justify-between w-full md:w-auto gap-4">
                    <span class="font-headline text-[0.55rem] text-surface-variant uppercase">AUTH_CODE</span>
                    <span class="font-headline text-xl text-primary-container tracking-[0.3em]">{{ $classroom->join_code }}</span>
                </div>
                <x-pixel-button variant="green" size="md" href="{{ route('admin.subjects.index', $classroom) }}" icon="menu_book" :full="true">
                    MANAGE_SUBJECTS
                </x-pixel-button>
            </div>
        </div>
    </x-pixel-card>

    {{-- Player Roster Title --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-secondary-container text-2xl">groups</span>
        <h2 class="font-headline text-lg text-on-surface uppercase tracking-wider">PLAYER ROSTER</h2>
    </div>

    {{-- Roster Grid --}}
    @if($students->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center bg-background/50">
            <span class="material-symbols-outlined text-surface-variant text-7xl mb-4">person_off</span>
            <p class="font-headline text-sm text-surface-variant uppercase mb-4">SIGNAL LOST: 0 PLAYERS DETECTED</p>
            <p class="font-body text-xl text-on-surface-variant max-w-lg mx-auto">
                The roster is empty. Share the authorization code <span class="text-primary-container font-headline tracking-widest">{{ $classroom->join_code }}</span> with your students so they can enter the guild.
            </p>
        </x-pixel-card>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($students as $student)
                <x-pixel-card variant="low" padding="md" class="hover:-translate-y-1 transition-transform relative overflow-hidden group">
                    {{-- Online Indicator --}}
                    <div class="absolute top-3 right-3 w-3 h-3 bg-secondary-container rounded-full animate-pulse border-2 border-black" title="System Link Active"></div>
                    
                    <div class="flex flex-col items-center text-center">
                        {{-- Avatar --}}
                        <div class="w-20 h-20 border-4 border-black bg-surface-container-high flex items-center justify-center mb-3 shadow-[4px_4px_0_0_#000] group-hover:scale-105 transition-transform">
                            @if($student->avatar && strlen($student->avatar) > 10)
                                {{-- It's an uploaded file path --}}
                                <img src="{{ asset('storage/' . $student->avatar) }}" alt="{{ $student->name }}" class="w-full h-full object-cover pixel-corners">
                            @else
                                {{-- It's an old default emoji or null --}}
                                <div class="text-4xl">{{ $student->avatar ?? '🧙♂️' }}</div>
                            @endif
                        </div>

                        {{-- Name & Rank --}}
                        <h3 class="font-headline text-[0.7rem] text-primary-container uppercase truncate w-full px-2 mb-1">{{ $student->name }}</h3>
                        <span class="font-headline text-[0.55rem] text-secondary-container rank-badge rank-{{ strtolower($student->rank) }} leading-none mb-4">
                            {{ $student->rank }}
                        </span>

                        {{-- Stats --}}
                        <div class="w-full grid grid-cols-2 gap-2 mt-auto">
                            <div class="bg-surface-container border-2 border-black py-2 flex flex-col items-center justify-center">
                                <span class="font-headline text-[0.45rem] text-surface-variant uppercase mb-1">LEVEL</span>
                                <span class="font-headline text-sm text-on-surface">{{ $student->level }}</span>
                            </div>
                            <div class="bg-surface-container border-2 border-black py-2 flex flex-col items-center justify-center">
                                <span class="font-headline text-[0.45rem] text-surface-variant uppercase mb-1">XP</span>
                                <span class="font-headline text-sm text-primary-container">{{ number_format($student->xp) }}</span>
                            </div>
                        </div>
                    </div>
                </x-pixel-card>
            @endforeach
        </div>
    @endif
</div>
@endsection
