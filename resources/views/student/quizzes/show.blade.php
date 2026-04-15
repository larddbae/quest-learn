@extends('layouts.student')

@section('title', 'Quiz Arena — ' . $quest->title)

@section('main')
<div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-5xl mb-3">⚔️</div>
        <h1 class="font-pixel text-lg text-pixel-gold mb-2">QUIZ ARENA</h1>
        <p class="font-pixel text-[10px] text-pixel-text-muted">{{ $quest->title }}</p>
        <p class="font-pixel text-[9px] text-pixel-green mt-1">{{ $quizzes->count() }} {{ Str::plural('Question', $quizzes->count()) }} • {{ $quest->xp_reward }} XP Reward</p>
    </div>

    <form method="POST" action="{{ route('student.quizzes.submit', $quest) }}" id="quizForm">
        @csrf

        @foreach($quizzes as $qIndex => $quiz)
            <div class="pixel-box p-6 mb-6">
                <h3 class="font-pixel text-[10px] text-pixel-cyan mb-4">
                    QUESTION {{ $qIndex + 1 }} / {{ $quizzes->count() }}
                </h3>
                <p class="font-pixel-body text-xl text-pixel-text mb-5">{{ $quiz->question }}</p>

                <div class="space-y-3">
                    @foreach(['a', 'b', 'c', 'd'] as $option)
                        <label class="quiz-option cursor-pointer block" onclick="selectOption(this, 'quiz_{{ $quiz->id }}')">
                            <input type="radio" name="quiz_{{ $quiz->id }}" value="{{ $option }}" class="hidden" required>
                            <span class="font-pixel text-[10px] text-pixel-gold w-8">{{ strtoupper($option) }}.</span>
                            <span class="font-pixel-body text-xl text-pixel-text">{{ $quiz->{'option_' . $option} }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="pixel-btn pixel-btn-gold text-lg" onclick="return confirmSubmit()">
                ⚔️ SUBMIT ANSWERS
            </button>
        </div>
    </form>
</div>

<script>
function selectOption(label, name) {
    document.querySelectorAll(`label[onclick*="${name}"]`).forEach(el => el.classList.remove('selected'));
    label.classList.add('selected');
}

function confirmSubmit() {
    return confirm('Are you sure you want to submit your answers? This cannot be undone!');
}
</script>
@endsection
