@extends('layouts.admin')
@section('title', 'Quests — ' . $subject->name)
@section('main')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.subjects.index', $subject->classroom) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ {{ $subject->name }}</a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold">⚔️ QUESTS</h1>
        <a href="{{ route('admin.quests.create', $subject) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ NEW QUEST</a>
    </div>

    @forelse($quests as $quest)
        <div class="pixel-card p-6 mb-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-pixel text-[11px] text-pixel-text">#{{ $quest->order }} — {{ $quest->title }}</h3>
                    <p class="font-pixel-body text-lg text-pixel-text-muted">{{ $quest->description ?? 'No description' }}</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="font-pixel text-[9px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>
                        <span class="font-pixel text-[9px] {{ $quest->material ? 'text-pixel-green' : 'text-pixel-red' }}">
                            {{ $quest->material ? '📜 Has Material' : '⚠️ No Material' }}
                        </span>
                        <span class="font-pixel text-[9px] text-pixel-cyan">
                            📝 {{ $quest->material ? $quest->material->quizzes->count() : 0 }} Quizzes
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-wrap">
                    @if($quest->material)
                        <a href="{{ route('admin.materials.edit', $quest) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm">📜 MATERIAL</a>
                    @else
                        <a href="{{ route('admin.materials.create', $quest) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">✚ MATERIAL</a>
                    @endif
                    <a href="{{ route('admin.quizzes.index', $quest) }}" class="pixel-btn pixel-btn-purple pixel-btn-sm">📝 QUIZZES</a>
                    <a href="{{ route('admin.quests.edit', [$subject, $quest]) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️</a>
                    <form method="POST" action="{{ route('admin.quests.destroy', [$subject, $quest]) }}" class="inline"
                          onsubmit="return confirm('Delete this quest?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="pixel-box p-12 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No quests yet. Create your first quest!</p>
        </div>
    @endforelse
</div>
@endsection
