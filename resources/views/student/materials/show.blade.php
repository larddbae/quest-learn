@extends('layouts.student')

@section('title', $material->title . ' — Learning Room')

@section('main')
<div class="max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.quests.index', $quest->subject_id) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold">
            ◀ {{ $quest->subject->name }}
        </a>
    </div>

    {{-- Material Header --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="font-pixel text-sm text-pixel-gold mb-2">📜 {{ $material->title }}</h1>
                <p class="font-pixel-body text-lg text-pixel-text-muted">Quest: {{ $quest->title }} • {{ $quest->xp_reward }} XP</p>
            </div>
            <form method="POST" action="{{ route('student.materials.bookmark', $material->id) }}">
                @csrf
                <button type="submit" class="pixel-btn pixel-btn-sm {{ $isBookmarked ? 'pixel-btn-gold' : 'pixel-btn-blue' }}">
                    {{ $isBookmarked ? '★ SAVED' : '☆ SAVE' }}
                </button>
            </form>
        </div>
    </div>

    {{-- Video Embed --}}
    @if($material->video_url)
        <div class="pixel-box p-4 mb-6">
            <div class="aspect-video">
                @php
                    $videoId = '';
                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $material->video_url, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                @if($videoId)
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                            class="w-full h-full border-4 border-black"
                            allowfullscreen></iframe>
                @else
                    <a href="{{ $material->video_url }}" target="_blank" class="pixel-btn pixel-btn-blue">
                        🎬 WATCH VIDEO
                    </a>
                @endif
            </div>
        </div>
    @endif

    {{-- Material Content --}}
    <div class="pixel-box p-6 mb-6">
        <div class="font-pixel-body text-xl leading-relaxed text-pixel-text prose-invert max-w-none">
            {!! nl2br(e($material->content)) !!}
        </div>
    </div>

    {{-- Quiz CTA --}}
    @if($quizCount > 0)
        <div class="pixel-box p-6 text-center animate-glow">
            <div class="text-4xl mb-3">⚔️</div>
            <h3 class="font-pixel text-sm text-pixel-gold mb-2">READY FOR THE QUIZ?</h3>
            <p class="font-pixel-body text-lg text-pixel-text-muted mb-4">
                Answer {{ $quizCount }} {{ Str::plural('question', $quizCount) }} to complete this quest and earn {{ $quest->xp_reward }} XP!
            </p>
            <a href="{{ route('student.quizzes.show', $quest) }}" class="pixel-btn pixel-btn-green">
                ⚔️ ENTER QUIZ ARENA
            </a>
        </div>
    @else
        <div class="pixel-box p-6 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No quiz available for this quest yet.</p>
        </div>
    @endif
</div>
@endsection
