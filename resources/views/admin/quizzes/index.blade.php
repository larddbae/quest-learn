@extends('layouts.admin')

@section('title', 'Manage Quizzes (Enemies)')

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Arcade Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="mb-4 md:mb-0 text-center md:text-left">
            <div class="flex items-center gap-3 justify-center md:justify-start">
                <span class="material-symbols-outlined text-error text-5xl" style="font-variation-settings: 'FILL' 1;">pest_control</span>
                <h1 class="font-headline text-3xl text-error pixel-glow uppercase tracking-widest">
                    ENEMY BESTIARY
                </h1>
            </div>
            <div class="inline-block bg-background border-2 border-error px-6 py-2 mt-4 text-center">
                <p class="font-headline text-[0.7rem] text-error uppercase tracking-wider">
                    GLOBAL REPOSITORY OF DEPLOYED QUIZ ENTITIES
                </p>
            </div>
        </div>
        <div>
            <x-pixel-button variant="error" size="lg" href="{{ route('admin.quizzes.create') }}" icon="crisis_alert">
                DEPLOY ENEMY
            </x-pixel-button>
        </div>
    </div>

    @if($quizzes->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">search_off</span>
            <p class="font-headline text-[0.8rem] text-surface-variant uppercase tracking-widest mt-2">REPOSITORY EMPTY</p>
            <p class="font-body text-lg text-on-surface-variant mt-4">No enemies have been deployed yet.</p>
        </x-pixel-card>
    @else
        <x-pixel-card variant="low" padding="sm" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b-4 border-black">
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">LORE MATERIAL ORIGIN</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">ENEMY PROMPT (QUESTION)</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase text-center hidden md:table-cell">TARGET ACTION (ANSWER)</th>
                        <th class="p-4 font-headline text-[0.6rem] text-error uppercase text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr class="border-b-2 border-surface-container hover:bg-surface-container transition-colors text-on-surface h-16 group">
                            {{-- Material/Quest Origin --}}
                            <td class="p-4 w-1/3">
                                <div class="flex flex-col gap-1 items-start">
                                    <div class="flex items-center gap-1">
                                        <span class="font-headline text-[0.5rem] bg-surface-container-highest border border-surface-variant/30 px-1.5 py-0.5 uppercase text-surface-variant limit-text">
                                            {{ $quiz->material->quest->subject->classroom->name ?? 'NO GUILD' }}
                                        </span>
                                    </div>
                                    <div class="flex flex-col gap-1 mt-1">
                                        <span class="font-headline text-[0.55rem] text-primary-container px-1 uppercase tracking-wider">
                                            Q: {{ $quiz->material->quest->title ?? 'NO QUEST' }}
                                        </span>
                                        <span class="font-headline text-[0.6rem] bg-background border border-secondary-container/50 px-2 py-1 uppercase text-secondary-container shadow-[2px_2px_0_0_#000]">
                                            L: {{ $quiz->material->title ?? 'NO LORE' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            {{-- Question --}}
                            <td class="p-4 w-1/3">
                                <div class="font-body text-md font-bold text-error break-words whitespace-normal max-w-[250px] leading-tight">
                                    {{ $quiz->question }}
                                </div>
                            </td>

                            {{-- Correct Answer --}}
                            <td class="p-4 text-center hidden md:table-cell w-1/6">
                                <div class="inline-flex flex-col items-center gap-1">
                                    <span class="font-headline text-[0.7rem] bg-error/10 border border-error/50 px-2 py-1 text-error shadow-[2px_2px_0_0_#000]">
                                        ACT: {{ strtoupper($quiz->correct_answer) }}
                                    </span>
                                    <span class="font-body text-[0.6rem] text-surface-variant truncate max-w-[120px]" title="{{ $quiz->{'option_' . $quiz->correct_answer} }}">
                                        {{ $quiz->{'option_' . $quiz->correct_answer} }}
                                    </span>
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="p-4 text-right w-1/6">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-[#ffd700] hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-2xl drop-shadow-[1px_1px_0_#000]" style="font-variation-settings: 'FILL' 1;">edit_square</span>
                                    </a>
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline" onsubmit="return confirm('WARNING: DELETING THIS ENEMY WILL REMOVE IT PERMANENTLY. PROCEED?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-error hover:text-white transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-2xl drop-shadow-[1px_1px_0_#000]" style="font-variation-settings: 'FILL' 1;">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-pixel-card>
    @endif
</div>
@endsection
