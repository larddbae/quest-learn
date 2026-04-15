@extends('layouts.admin')
@section('title', 'Edit Badge')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.badges.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ BADGE FORGE</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✏️ EDIT BADGE</h1>
        <form method="POST" action="{{ route('admin.badges.update', $badge) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="pixel-label">🏅 Badge Name</label>
                <input type="text" name="name" value="{{ old('name', $badge->name) }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea" required>{{ old('description', $badge->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="pixel-label">📊 Criteria Type</label>
                    <select name="criteria_type" required class="pixel-select">
                        <option value="quests_completed" {{ old('criteria_type', $badge->criteria_type) === 'quests_completed' ? 'selected' : '' }}>Quests Completed</option>
                        <option value="perfect_score" {{ old('criteria_type', $badge->criteria_type) === 'perfect_score' ? 'selected' : '' }}>Perfect Scores</option>
                        <option value="xp_earned" {{ old('criteria_type', $badge->criteria_type) === 'xp_earned' ? 'selected' : '' }}>XP Earned</option>
                        <option value="level_reached" {{ old('criteria_type', $badge->criteria_type) === 'level_reached' ? 'selected' : '' }}>Level Reached</option>
                    </select>
                </div>
                <div>
                    <label class="pixel-label"># Value</label>
                    <input type="number" name="criteria_value" value="{{ old('criteria_value', $badge->criteria_value) }}" required class="pixel-input" min="1">
                </div>
            </div>
            <div class="mb-6">
                <label class="pixel-label">🖼️ Icon (Pixel Art PNG)</label>
                @if($badge->icon_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->name }}" class="w-16 h-16 pixel-image">
                    </div>
                @endif
                <input type="file" name="icon" accept="image/*" class="pixel-input">
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">Leave empty to keep current icon.</p>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">💾 SAVE CHANGES</button>
        </form>
    </div>
</div>
@endsection
