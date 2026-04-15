@extends('layouts.student')

@section('title', 'Subject Hub')

@section('main')
<div class="max-w-6xl mx-auto">
    <h1 class="font-pixel text-lg text-pixel-gold mb-6">📚 SUBJECT HUB</h1>

    @if($subjects->isEmpty())
        <div class="pixel-box p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <h2 class="font-pixel text-sm text-pixel-text-muted mb-2">NO SUBJECTS YET</h2>
            <p class="font-pixel-body text-xl text-pixel-text-muted">Your Game Master hasn't added any subjects. Check back soon!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($subjects as $subject)
                <a href="{{ route('student.quests.index', $subject) }}" class="pixel-card p-6 block group">
                    <div class="text-center">
                        <div class="text-5xl mb-4 group-hover:animate-float">
                            {{ $subject->icon ?? '📖' }}
                        </div>
                        <h3 class="font-pixel text-[11px] text-pixel-gold mb-2">{{ $subject->name }}</h3>
                        @if($subject->description)
                            <p class="font-pixel-body text-lg text-pixel-text-muted mb-3">
                                {{ Str::limit($subject->description, 80) }}
                            </p>
                        @endif
                        <div class="font-pixel text-[9px] text-pixel-cyan">
                            {{ $subject->quests_count }} {{ Str::plural('QUEST', $subject->quests_count) }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
