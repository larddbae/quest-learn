@extends('layouts.admin')

@section('title', $classroom->name . ' — Live Monitoring')

@section('main')
<div class="max-w-6xl mx-auto">
    <a href="{{ route('admin.classrooms.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">
        ◀ GUILDS
    </a>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="font-pixel text-lg text-pixel-gold">🏰 {{ $classroom->name }}</h1>
            <p class="font-pixel text-[10px] text-pixel-text-muted mt-1">JOIN CODE: <span class="text-pixel-cyan">{{ $classroom->join_code }}</span></p>
        </div>
        <a href="{{ route('admin.subjects.index', $classroom) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">📚 MANAGE SUBJECTS</a>
    </div>

    <h2 class="font-pixel text-sm text-pixel-gold mb-4">👥 PLAYER MONITORING ({{ $students->count() }} Players)</h2>

    @if($students->isEmpty())
        <div class="pixel-box p-12 text-center">
            <div class="text-5xl mb-4">👤</div>
            <p class="font-pixel text-[10px] text-pixel-text-muted mb-2">No players have joined yet.</p>
            <p class="font-pixel-body text-lg text-pixel-text-muted">
                Share the join code <span class="text-pixel-gold font-bold">{{ $classroom->join_code }}</span> with your students.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($students as $student)
                <div class="pixel-card p-4 text-center">
                    <div class="text-4xl mb-2 pixel-image">{{ $student->avatar ?? '🧙' }}</div>
                    <h3 class="font-pixel text-[9px] text-pixel-text truncate">{{ $student->name }}</h3>
                    <span class="rank-badge rank-{{ strtolower($student->rank) }} mt-2" style="font-size: 7px;">{{ $student->rank }}</span>
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        <div class="pixel-box-light p-2">
                            <p class="font-pixel text-[10px] text-pixel-green">LVL {{ $student->level }}</p>
                        </div>
                        <div class="pixel-box-light p-2">
                            <p class="font-pixel text-[10px] text-pixel-cyan">{{ number_format($student->xp) }} XP</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
