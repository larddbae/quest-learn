@extends('layouts.admin')

@section('title', 'Guild Management')

@section('main')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold">⚔️ GUILDS</h1>
        <a href="{{ route('admin.classrooms.create') }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ NEW GUILD</a>
    </div>

    @forelse($classrooms as $classroom)
        <div class="pixel-card p-6 mb-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-pixel text-[11px] text-pixel-text">{{ $classroom->name }}</h3>
                    <p class="font-pixel-body text-lg text-pixel-text-muted">
                        {{ $classroom->description ?? 'No description' }}
                    </p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="font-pixel text-[9px] text-pixel-gold">CODE: {{ $classroom->join_code }}</span>
                        <span class="font-pixel text-[9px] text-pixel-green">{{ $classroom->students_count }} players</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.classrooms.show', $classroom) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm">👁️ VIEW</a>
                    <a href="{{ route('admin.subjects.index', $classroom) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">📚 SUBJECTS</a>
                    <a href="{{ route('admin.classrooms.edit', $classroom) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️ EDIT</a>
                    <form method="POST" action="{{ route('admin.classrooms.destroy', $classroom) }}" class="inline"
                          onsubmit="return confirm('Delete this guild? All data will be lost!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="pixel-box p-12 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No guilds yet.</p>
        </div>
    @endforelse
</div>
@endsection
