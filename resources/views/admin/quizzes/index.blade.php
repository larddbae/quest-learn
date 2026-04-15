@extends('layouts.admin')
@section('title', 'Quizzes — ' . $quest->title)
@section('main')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.quests.index', $quest->subject) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUESTS</a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold">📝 QUIZZES</h1>
        <a href="{{ route('admin.quizzes.create', $quest) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ ADD QUESTION</a>
    </div>

    <p class="font-pixel text-[10px] text-pixel-text-muted mb-4">Quest: {{ $quest->title }}</p>

    @forelse($quizzes as $qIndex => $quiz)
        <div class="pixel-card p-6 mb-4">
            <div class="flex justify-between items-start mb-3">
                <h3 class="font-pixel text-[10px] text-pixel-cyan">Q{{ $qIndex + 1 }}</h3>
                <div class="flex gap-2">
                    <a href="{{ route('admin.quizzes.edit', [$quest, $quiz]) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️</a>
                    <form method="POST" action="{{ route('admin.quizzes.destroy', [$quest, $quiz]) }}" class="inline"
                          onsubmit="return confirm('Delete this question?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                    </form>
                </div>
            </div>
            <p class="font-pixel-body text-xl text-pixel-text mb-4">{{ $quiz->question }}</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach(['a', 'b', 'c', 'd'] as $opt)
                    <div class="p-3 border-2 {{ $opt === $quiz->correct_answer ? 'border-green-500 bg-green-500/10' : 'border-white/10' }}">
                        <span class="font-pixel text-[9px] {{ $opt === $quiz->correct_answer ? 'text-pixel-green' : 'text-pixel-gold' }}">{{ strtoupper($opt) }}.</span>
                        <span class="font-pixel-body text-lg text-pixel-text ml-2">{{ $quiz->{'option_' . $opt} }}</span>
                        @if($opt === $quiz->correct_answer)
                            <span class="font-pixel text-[8px] text-pixel-green ml-1">✓</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="pixel-box p-12 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No quiz questions yet. Add your first question!</p>
        </div>
    @endforelse
</div>
@endsection
