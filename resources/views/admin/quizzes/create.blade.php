@extends('layouts.admin')

@section('title', 'Add Quiz Question')

@section('main')
<div class="max-w-3xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.index', $quest) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT DEPLOYMENT
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-error">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-error text-4xl" style="font-variation-settings: 'FILL' 1;">crisis_alert</span>
            <div>
                <h1 class="font-headline text-xl text-on-surface uppercase">DEPLOY NEW ENEMY</h1>
                <p class="font-pixel text-[9px] text-surface-variant mt-2 uppercase">QUEST: {{ $quest->title }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.quizzes.store', $quest) }}" class="space-y-8">
            @csrf

            {{-- Question --}}
            <div class="space-y-3">
                <label class="block font-headline text-[0.7rem] text-error uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">help_center</span> Enemy Prompt (Question)
                </label>
                <textarea name="question" rows="3" required
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-2xl focus:ring-0 focus:border-error transition-colors outline-none placeholder:text-surface-variant resize-y" 
                          placeholder="State the challenge...">{{ old('question') }}</textarea>
                @error('question') 
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Options Grid --}}
            <div class="bg-surface-container-high border-4 border-black p-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-primary-container/5 dithered-bg pointer-events-none opacity-50"></div>
                
                <h3 class="font-headline text-[0.6rem] text-primary-container uppercase relative z-10 flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">list_alt</span> Selectable Actions (Answers)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                        <div class="flex flex-col gap-1">
                            <label class="font-headline text-[0.6rem] text-on-surface uppercase ml-1">OPTION {{ strtoupper($opt) }}</label>
                            <div class="flex items-stretch shadow-[2px_2px_0_0_#000]">
                                <div class="w-10 bg-background border-y-4 border-l-4 border-black flex items-center justify-center font-headline text-[0.75rem] text-primary-container uppercase">
                                    {{ $opt }}
                                </div>
                                <input type="text" name="option_{{ $opt }}" value="{{ old('option_' . $opt) }}" required
                                       class="flex-1 bg-surface-container-lowest border-4 border-black p-3 text-on-surface font-body text-xl focus:ring-0 focus:border-primary-container outline-none placeholder:text-surface-variant">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Correct Answer Setup --}}
            <div class="space-y-3 pt-4 border-t-4 border-outline-variant">
                <label class="block font-headline text-[0.7rem] text-secondary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span> Correct Action (Target)
                </label>
                <div class="grid grid-cols-4 gap-4">
                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="correct_answer" value="{{ $opt }}" class="peer hidden" {{ old('correct_answer') === $opt ? 'checked' : '' }} required>
                            <div class="bg-surface-container border-4 border-black p-4 text-center group-hover:bg-surface-container-high transition-colors
                                        peer-checked:bg-secondary-container peer-checked:text-black peer-checked:shadow-[inset_0_0_0_4px_black]">
                                <span class="font-headline text-lg">{{ strtoupper($opt) }}</span>
                            </div>
                            <span class="material-symbols-outlined absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-black opacity-0 peer-checked:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.quizzes.index', $quest) }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="error" type="submit" size="lg" icon="crisis_alert" class="sm:flex-1">
                    DEPLOY_ENEMY
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
