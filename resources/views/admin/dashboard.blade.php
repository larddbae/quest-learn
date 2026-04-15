@extends('layouts.admin')

@section('title', 'Game Master Dashboard')

@section('main')
<div class="max-w-6xl mx-auto">
    <h1 class="font-pixel text-lg text-pixel-gold mb-6">🏰 GAME MASTER DASHBOARD</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="pixel-box p-6 text-center">
            <p class="font-pixel text-2xl text-pixel-gold">{{ $totalClassrooms }}</p>
            <p class="font-pixel text-[9px] text-pixel-text-muted mt-2">GUILDS</p>
        </div>
        <div class="pixel-box p-6 text-center">
            <p class="font-pixel text-2xl text-pixel-green">{{ $totalStudents }}</p>
            <p class="font-pixel text-[9px] text-pixel-text-muted mt-2">TOTAL PLAYERS</p>
        </div>
        <div class="pixel-box p-6 text-center">
            <a href="{{ route('admin.classrooms.create') }}" class="pixel-btn pixel-btn-gold w-full">
                ✚ CREATE GUILD
            </a>
        </div>
    </div>

    {{-- Classroom List --}}
    <h2 class="font-pixel text-sm text-pixel-gold mb-4">⚔️ YOUR GUILDS</h2>

    @forelse($classrooms as $classroom)
        <div class="pixel-card p-6 mb-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-pixel text-[11px] text-pixel-text">{{ $classroom->name }}</h3>
                    <p class="font-pixel-body text-lg text-pixel-text-muted mt-1">
                        {{ $classroom->students_count }} {{ Str::plural('player', $classroom->students_count) }}
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="pixel-box-light p-2 px-4">
                        <span class="font-pixel text-[9px] text-pixel-text-muted">CODE: </span>
                        <span class="font-pixel text-[10px] text-pixel-gold">{{ $classroom->join_code }}</span>
                    </div>
                    <a href="{{ route('admin.classrooms.show', $classroom) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm">
                        VIEW
                    </a>
                    <a href="{{ route('admin.subjects.index', $classroom) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">
                        SUBJECTS
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="pixel-box p-12 text-center">
            <div class="text-5xl mb-4">🏰</div>
            <p class="font-pixel text-[10px] text-pixel-text-muted mb-4">No guilds created yet.</p>
            <a href="{{ route('admin.classrooms.create') }}" class="pixel-btn pixel-btn-gold">✚ CREATE YOUR FIRST GUILD</a>
        </div>
    @endforelse
</div>
@endsection
