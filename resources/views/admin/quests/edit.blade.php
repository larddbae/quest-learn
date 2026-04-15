@extends('layouts.admin')
@section('title', 'Edit Quest')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.quests.index', $subject) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUESTS</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✏️ EDIT QUEST</h1>
        <form method="POST" action="{{ route('admin.quests.update', [$subject, $quest]) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="pixel-label">⚔️ Quest Title</label>
                <input type="text" name="title" value="{{ old('title', $quest->title) }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea">{{ old('description', $quest->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="pixel-label"># Order</label>
                    <input type="number" name="order" value="{{ old('order', $quest->order) }}" required class="pixel-input" min="0">
                </div>
                <div>
                    <label class="pixel-label">🌟 XP Reward</label>
                    <input type="number" name="xp_reward" value="{{ old('xp_reward', $quest->xp_reward) }}" required class="pixel-input" min="1">
                </div>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">💾 SAVE CHANGES</button>
        </form>
    </div>
</div>
@endsection
