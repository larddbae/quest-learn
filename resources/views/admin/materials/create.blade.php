@extends('layouts.admin')
@section('title', 'Create Material')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.quests.index', $quest->subject) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUESTS</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-2 text-center">📜 ADD MATERIAL</h1>
        <p class="font-pixel text-[9px] text-pixel-text-muted text-center mb-6">Quest: {{ $quest->title }}</p>
        <form method="POST" action="{{ route('admin.materials.store', $quest) }}">
            @csrf
            <div class="mb-5">
                <label class="pixel-label">📖 Material Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="pixel-input" placeholder="e.g., Chapter 1: Basics">
                @error('title') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-5">
                <label class="pixel-label">🎬 Video URL (Optional)</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" class="pixel-input" placeholder="https://youtube.com/watch?v=...">
            </div>
            <div class="mb-6">
                <label class="pixel-label">📝 Content</label>
                <textarea name="content" class="pixel-textarea" rows="10" required placeholder="Write your learning material here...">{{ old('content') }}</textarea>
                @error('content') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">📜 SAVE MATERIAL</button>
        </form>
    </div>
</div>
@endsection
