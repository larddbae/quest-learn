@extends('layouts.admin')
@section('title', 'Create Quest')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.quests.index', $subject) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUESTS</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✚ NEW QUEST</h1>
        <form method="POST" action="{{ route('admin.quests.store', $subject) }}">
            @csrf
            <div class="mb-5">
                <label class="pixel-label">⚔️ Quest Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="pixel-input" placeholder="e.g., Introduction to Algebra">
                @error('title') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-5">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea" placeholder="What will students learn in this quest?">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="pixel-label"># Order</label>
                    <input type="number" name="order" value="{{ old('order', $nextOrder) }}" required class="pixel-input" min="0">
                </div>
                <div>
                    <label class="pixel-label">🌟 XP Reward</label>
                    <input type="number" name="xp_reward" value="{{ old('xp_reward', 100) }}" required class="pixel-input" min="1">
                </div>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">✚ CREATE QUEST</button>
        </form>
    </div>
</div>
@endsection
