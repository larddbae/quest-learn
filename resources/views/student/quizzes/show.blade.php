@extends('layouts.student')

@section('title', 'Quiz Arena — ' . $quest->title)

@section('main')
<div class="max-w-4xl mx-auto pb-16">
    {{-- Battle Header --}}
    <div class="flex flex-col items-center justify-center text-center mb-10">
        <span class="material-symbols-outlined text-error text-6xl mb-4 animate-pulse" style="font-variation-settings: 'FILL' 1;">swords</span>
        <h1 class="font-headline text-3xl text-error uppercase tracking-widest bg-error/10 px-8 py-2 border-y-4 border-error pixel-glow mb-4">
            BATTLE ARENA
        </h1>
        <div class="flex items-center gap-4 text-on-surface-variant font-headline text-[0.6rem] uppercase">
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-primary-container">
                QUEST: {{ $quest->title }}
            </span>
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-secondary-container">
                {{ $quizzes->count() }} {{ Str::plural('ENEMY', $quizzes->count()) }}
            </span>
            <span class="bg-surface-container border-2 border-black px-3 py-1 text-primary-container">
                🌟 {{ $quest->xp_reward }} XP
            </span>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('student.quizzes.submit', $quest) }}" id="quizForm" class="space-y-12">
        @csrf

        @foreach($quizzes as $qIndex => $quiz)
            {{-- Combast Instance (Question Block) --}}
            <div class="relative">
                {{-- Enemy Encounter Header --}}
                <div class="absolute -top-4 left-6 z-10 bg-error border-4 border-black text-white px-4 py-1 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">skull</span>
                    <span class="font-headline text-[0.6rem] uppercase">ENEMY {{ $qIndex + 1 }} / {{ $quizzes->count() }}</span>
                </div>

                {{-- Battle Screen Container --}}
                <div class="border-4 border-black bg-surface-container-lowest flex flex-col md:flex-row h-auto md:h-[400px] shadow-[8px_8px_0_0_#000]">
                    
                    {{-- TOP/LEFT HALF: The "Enemy" (Question) --}}
                    <div class="flex-1 bg-surface-container-high border-b-4 md:border-b-0 md:border-r-4 border-black p-8 flex flex-col relative overflow-hidden">
                        {{-- Decorative scanlines --}}
                        <div class="absolute inset-0 pointer-events-none opacity-20 dithered-bg"></div>
                        
                        <div class="flex-1 flex flex-col justify-center relative z-10">
                            <span class="material-symbols-outlined text-surface-variant text-6xl mb-6">help_center</span>
                            <p class="font-body text-2xl md:text-3xl text-on-surface leading-snug">
                                {{ $quiz->question }}
                            </p>
                        </div>
                    </div>

                    {{-- BOTTOM/RIGHT HALF: The Action Menu (Answers) --}}
                    <div class="w-full md:w-[45%] bg-[#1A1A3E] p-6 flex flex-col justify-center">
                        <p class="font-headline text-[0.6rem] text-primary-container mb-4 flex items-center gap-2 uppercase">
                            <span class="material-symbols-outlined text-sm">touch_app</span> Choose Action:
                        </p>
                        
                        <div class="space-y-3">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                <label class="block relative cursor-pointer group" onclick="selectOption(this, 'quiz_{{ $quiz->id }}')">
                                    {{-- Hidden native radio --}}
                                    <input type="radio" name="quiz_{{ $quiz->id }}" value="{{ $option }}" class="peer hidden" required>
                                    
                                    {{-- Custom chunky button --}}
                                    <div class="w-full bg-surface-container-lowest border-4 border-black text-on-surface p-4 flex items-center gap-4 transition-all
                                                group-hover:bg-surface-container group-hover:-translate-y-1 group-hover:shadow-[4px_4px_0_0_#000]
                                                peer-checked:bg-primary-container peer-checked:text-black peer-checked:border-black peer-checked:translate-y-0 peer-checked:shadow-none">
                                        
                                        {{-- Option Letter (A, B, C, D) --}}
                                        <div class="w-8 h-8 flex-shrink-0 bg-background border-2 border-black flex items-center justify-center font-headline text-[0.7rem] uppercase text-on-surface">
                                            {{ $option }}
                                        </div>
                                        
                                        {{-- Answer Text --}}
                                        <span class="font-body text-xl flex-1 leading-tight">
                                            {{ $quiz->{'option_' . $option} }}
                                        </span>
                                    </div>
                                    
                                    {{-- Checked Indicator (Sword) --}}
                                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-black opacity-0 peer-checked:opacity-100 transition-opacity text-2xl" style="font-variation-settings: 'FILL' 1;">
                                        swords
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

        {{-- Final Execution Button --}}
        <div class="pt-8 text-center border-t-4 border-outline-variant mt-16 max-w-sm mx-auto">
            <h3 class="font-headline text-sm text-on-surface uppercase mb-6">ALL ENEMIES DEFEATED?</h3>
            <button type="submit" class="w-full bg-error text-white font-headline text-lg border-4 border-black py-5 shadow-[6px_6px_0_0_#000] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000] active:translate-y-1 active:shadow-none transition-all flex justify-center items-center gap-3 uppercase" onclick="return confirmSubmit()">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">crisis_alert</span>
                Execute Attack
            </button>
        </div>
    </form>
</div>

<script>
// The selectOption from original logic is mostly handled by CSS peer-checked now, 
// but we keep this function signature intact in case of any external calls, 
// and to remove any rogue visual classes if they existed.
function selectOption(label, name) {
    // The native input state handles the styling via tailwind peer-checked classes!
}

function confirmSubmit() {
    // Check if all questions are answered
    const totalQuestions = {{ $quizzes->count() }};
    const answeredGroups = new Set();
    
    document.querySelectorAll('input[type="radio"]:checked').forEach(input => {
        answeredGroups.add(input.name);
    });

    if (answeredGroups.size < totalQuestions) {
        alert(`You must select an action for all ${totalQuestions} enemies before executing!`);
        return false;
    }

    return confirm('EXECUTE BATTLE SEQUENCE? This action is final and will consume your attempt.');
}
</script>
@endsection
