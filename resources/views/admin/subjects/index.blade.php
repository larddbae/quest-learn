@extends('layouts.admin')

@section('title', 'Manage Subjects')

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Arcade Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="mb-4 md:mb-0 text-center md:text-left">
            <div class="flex items-center gap-3 justify-center md:justify-start">
                <span class="material-symbols-outlined text-primary-container text-5xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                <h1 class="font-headline text-3xl text-primary-container pixel-glow uppercase tracking-widest">
                    SUBJECTS DATABASE
                </h1>
            </div>
            <div class="inline-block bg-background border-2 border-primary-container px-6 py-2 mt-4 text-center">
                <p class="font-headline text-[0.7rem] text-secondary-container uppercase tracking-wider">
                    GLOBAL INDEX OF ALL ESTABLISHED DISCIPLINES
                </p>
            </div>
        </div>
        <div>
            <x-pixel-button variant="gold" size="lg" href="{{ route('admin.subjects.create') }}" icon="add_box">
                ESTABLISH SUBJECT
            </x-pixel-button>
        </div>
    </div>

    @if($subjects->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">search_off</span>
            <p class="font-headline text-[0.8rem] text-surface-variant uppercase tracking-widest mt-2">DATABASE EMPTY</p>
            <p class="font-body text-lg text-on-surface-variant mt-4">No subjects have been established yet.</p>
        </x-pixel-card>
    @else
        <x-pixel-card variant="low" padding="sm" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b-4 border-black">
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">GUILD</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">SUBJECT</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase hidden md:table-cell">CODEX (DESC)</th>
                        <th class="p-4 font-headline text-[0.6rem] text-primary-container uppercase text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr class="border-b-2 border-surface-container hover:bg-surface-container transition-colors text-on-surface h-16 group">
                            {{-- Guild --}}
                            <td class="p-4 w-1/4">
                                <span class="font-headline text-[0.65rem] bg-surface-container-highest border border-surface-variant/30 px-2 py-1 uppercase text-surface-variant shadow-[2px_2px_0_0_#000]">
                                    {{ $subject->classroom->name ?? 'NO GUILD' }}
                                </span>
                            </td>

                            {{-- Subject Name --}}
                            <td class="p-4 w-1/4">
                                <div class="font-body text-lg font-bold text-primary-container">{{ $subject->name }}</div>
                            </td>

                            {{-- Description --}}
                            <td class="p-4 hidden md:table-cell w-1/3">
                                <div class="font-body text-sm text-surface-variant truncate max-w-[250px]" title="{{ $subject->description }}">
                                    {{ $subject->description ?: 'No description' }}
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="p-4 text-right w-1/6">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-[#ffd700] hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-2xl drop-shadow-[1px_1px_0_#000]" style="font-variation-settings: 'FILL' 1;">edit_square</span>
                                    </a>
                                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('WARNING: DELETING THIS SUBJECT WILL WIPE ALL ASSOCIATED QUESTS, LORE, AND ENEMIES. PROCEED WITH EXTREME CAUTION.');">
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
