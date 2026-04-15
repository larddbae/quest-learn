@extends('layouts.admin')
@section('title', 'Edit Quiz Question')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.quizzes.index', $quest) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ QUIZZES</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✏️ EDIT QUESTION</h1>
        <form method="POST" action="{{ route('admin.quizzes.update', [$quest, $quiz]) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="pixel-label">❓ Question</label>
                <textarea name="question" class="pixel-textarea" required>{{ old('question', $quiz->question) }}</textarea>
            </div>
            <div class="mb-5">
                <label class="pixel-label">A. Option A</label>
                <input type="text" name="option_a" value="{{ old('option_a', $quiz->option_a) }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">B. Option B</label>
                <input type="text" name="option_b" value="{{ old('option_b', $quiz->option_b) }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">C. Option C</label>
                <input type="text" name="option_c" value="{{ old('option_c', $quiz->option_c) }}" required class="pixel-input">
            </div>
            <div class="mb-5">
                <label class="pixel-label">D. Option D</label>
                <input type="text" name="option_d" value="{{ old('option_d', $quiz->option_d) }}" required class="pixel-input">
            </div>
            <div class="mb-6">
                <label class="pixel-label">✅ Correct Answer</label>
                <select name="correct_answer" required class="pixel-select">
                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                        <option value="{{ $opt }}" {{ old('correct_answer', $quiz->correct_answer) === $opt ? 'selected' : '' }}>{{ strtoupper($opt) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">💾 SAVE CHANGES</button>
        </form>
    </div>
</div>
@endsection
