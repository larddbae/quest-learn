@extends('layouts.student')

@section('title', 'Learning Room')

@section('main')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="pixel-box p-6 mb-6">
        <h1 class="font-pixel text-lg text-pixel-gold mb-2">📜 LEARNING ROOM</h1>
        <p class="font-pixel-body text-xl text-pixel-text-muted">
            Read materials, watch videos, and bookmark content for later review.
        </p>
    </div>

    {{-- In-Progress Materials --}}
    <h2 class="font-pixel text-sm text-pixel-green mb-4">⚔️ AVAILABLE MATERIALS</h2>

    @if($inProgressQuests->isEmpty())
        <div class="pixel-box p-8 text-center mb-8">
            <div class="text-4xl mb-2">📭</div>
            <p class="font-pixel text-[9px] text-pixel-text-muted">
                No new materials to read. Complete current quizzes or wait for new quests!
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($inProgressQuests as $quest)
                <a href="{{ route('student.materials.show', $quest) }}" class="pixel-card p-5 block group">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl group-hover:animate-float">📜</div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-pixel text-[10px] text-pixel-gold mb-1 truncate">{{ $quest->material->title }}</h3>
                            <p class="font-pixel-body text-base text-pixel-text-muted">
                                {{ $quest->subject->name }} • {{ $quest->title }}
                            </p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="font-pixel text-[8px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>
                                @if($quest->material->video_url)
                                    <span class="font-pixel text-[8px] text-pixel-cyan">🎬 VIDEO</span>
                                @endif
                                @if($quest->material->quizzes->count() > 0)
                                    <span class="font-pixel text-[8px] text-pixel-purple">📝 {{ $quest->material->quizzes->count() }} QUIZ</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Bookmarked Materials --}}
    <h2 class="font-pixel text-sm text-pixel-gold mb-4">📚 BOOKMARKS</h2>

    @if($bookmarks->isEmpty())
        <div class="pixel-box p-8 text-center mb-8">
            <div class="text-4xl mb-2">📚</div>
            <p class="font-pixel text-[9px] text-pixel-text-muted">
                No bookmarks yet. Save materials you want to review later!
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($bookmarks as $bookmark)
                <a href="{{ route('student.materials.show', $bookmark->material->quest_id) }}"
                   class="pixel-card p-5 block group">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl">⭐</div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-pixel text-[10px] text-pixel-text mb-1 truncate">{{ $bookmark->material->title }}</h3>
                            <p class="font-pixel-body text-base text-pixel-text-muted">
                                {{ $bookmark->material->quest->subject->name ?? '' }} • {{ $bookmark->material->quest->title ?? '' }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Completed Materials (for review) --}}
    <h2 class="font-pixel text-sm text-pixel-cyan mb-4">✅ COMPLETED (REVIEW)</h2>

    @if($completedQuests->isEmpty())
        <div class="pixel-box p-8 text-center">
            <div class="text-4xl mb-2">🗺️</div>
            <p class="font-pixel text-[9px] text-pixel-text-muted">
                Complete quests to unlock materials for review.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($completedQuests as $quest)
                <a href="{{ route('student.materials.show', $quest) }}" class="pixel-card p-5 block group" style="opacity: 0.85;">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl">✅</div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-pixel text-[10px] text-pixel-text mb-1 truncate">{{ $quest->material->title }}</h3>
                            <p class="font-pixel-body text-base text-pixel-text-muted">
                                {{ $quest->subject->name }} • {{ $quest->title }}
                            </p>
                            @if($quest->userProgress->first())
                                <span class="font-pixel text-[8px] text-pixel-green mt-1 inline-block">
                                    SCORE: {{ $quest->userProgress->first()->score }}/{{ $quest->userProgress->first()->total_questions }}
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
