@extends('layouts.admin')
@section('title', 'Add Quiz Question')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.quizzes.index', $quest) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUIZZES</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-2 text-center">✚ ADD QUESTION</h1>
        <p class="font-pixel text-[9px] text-pixel-text-muted text-center mb-6">Quest: {{ $quest->title }}</p>
        <form method="POST" action="{{ route('admin.quizzes.store', $quest) }}">
            @csrf
            <div class="mb-5">
                <label class="pixel-label">❓ Question</label>
                <textarea name="question" class="pixel-textarea" required placeholder="Enter your question...">{{ old('question') }}</textarea>
                @error('question') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-5">
                <label class="pixel-label">A. Option A</label>
                <input type="text" name="option_a" value="{{ old('option_a') }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">B. Option B</label>
                <input type="text" name="option_b" value="{{ old('option_b') }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">C. Option C</label>
                <input type="text" name="option_c" value="{{ old('option_c') }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">D. Option D</label>
                <input type="text" name="option_d" value="{{ old('option_d') }}" required class="pixel-input">
            </div>
            <div class="mb-6">
                <label class="pixel-label">✅ Correct Answer</label>
                <select name="correct_answer" required class="pixel-select">
                    <option value="a" {{ old('correct_answer') === 'a' ? 'selected' : '' }}>A</option>
                    <option value="b" {{ old('correct_answer') === 'b' ? 'selected' : '' }}>B</option>
                    <option value="c" {{ old('correct_answer') === 'c' ? 'selected' : '' }}>C</option>
                    <option value="d" {{ old('correct_answer') === 'd' ? 'selected' : '' }}>D</option>
                </select>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">✚ ADD QUESTION</button>
        </form>
    </div>
</div>
@endsection
