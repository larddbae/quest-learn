@extends('layouts.admin')
@section('title', 'Forge Badge')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.badges.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ BADGE FORGE</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">⚒️ FORGE NEW BADGE</h1>
        <form method="POST" action="{{ route('admin.badges.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label class="pixel-label">🏅 Badge Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="pixel-input" placeholder="e.g., First Quest">
                @error('name') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-5">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea" required placeholder="What must a player achieve to earn this badge?">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="pixel-label">📊 Criteria Type</label>
                    <select name="criteria_type" required class="pixel-select">
                        <option value="quests_completed" {{ old('criteria_type') === 'quests_completed' ? 'selected' : '' }}>Quests Completed</option>
                        <option value="perfect_score" {{ old('criteria_type') === 'perfect_score' ? 'selected' : '' }}>Perfect Scores</option>
                        <option value="xp_earned" {{ old('criteria_type') === 'xp_earned' ? 'selected' : '' }}>XP Earned</option>
                        <option value="level_reached" {{ old('criteria_type') === 'level_reached' ? 'selected' : '' }}>Level Reached</option>
                    </select>
                </div>
                <div>
                    <label class="pixel-label"># Value</label>
                    <input type="number" name="criteria_value" value="{{ old('criteria_value', 1) }}" required class="pixel-input" min="1">
                </div>
            </div>
            <div class="mb-6">
                <label class="pixel-label">🖼️ Icon (Pixel Art PNG)</label>
                <input type="file" name="icon" accept="image/*" class="pixel-input">
                <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">Optional. Max 2MB.</p>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">⚒️ FORGE BADGE</button>
        </form>
    </div>
</div>
@endsection
