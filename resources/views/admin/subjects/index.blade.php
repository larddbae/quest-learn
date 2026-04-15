@extends('layouts.admin')

@section('title', 'Subjects — ' . $classroom->name)

@section('main')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.classrooms.show', $classroom) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">
        ◀ {{ $classroom->name }}
    </a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold">📚 SUBJECTS</h1>
        <a href="{{ route('admin.subjects.create', $classroom) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ NEW SUBJECT</a>
    </div>

    @forelse($subjects as $subject)
        <div class="pixel-card p-6 mb-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-pixel text-[11px] text-pixel-text">{{ $subject->icon ?? '📖' }} {{ $subject->name }}</h3>
                    <p class="font-pixel-body text-lg text-pixel-text-muted">{{ $subject->description ?? 'No description' }}</p>
                    <span class="font-pixel text-[9px] text-pixel-cyan">{{ $subject->quests_count }} quests</span>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.quests.index', $subject) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">⚔️ QUESTS</a>
                    <a href="{{ route('admin.subjects.edit', [$classroom, $subject]) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️</a>
                    <form method="POST" action="{{ route('admin.subjects.destroy', [$classroom, $subject]) }}" class="inline"
                          onsubmit="return confirm('Delete this subject and all its quests?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="pixel-box p-12 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No subjects yet. Create your first subject!</p>
        </div>
    @endforelse
</div>
@endsection
