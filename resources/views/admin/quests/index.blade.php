@extends('layouts.admin')

@section('title', 'Manage Quests')

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Arcade Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="mb-4 md:mb-0 text-center md:text-left">
            <div class="flex items-center gap-3 justify-center md:justify-start">
                <span class="material-symbols-outlined text-primary-container text-5xl" style="font-variation-settings: 'FILL' 1;">swords</span>
                <h1 class="font-headline text-3xl text-primary-container pixel-glow uppercase tracking-widest">
                    QUEST BOARD
                </h1>
            </div>
            <div class="inline-block bg-background border-2 border-primary-container px-6 py-2 mt-4 text-center">
                <p class="font-headline text-[0.7rem] text-secondary-container uppercase tracking-wider">
                    GLOBAL INDEX OF ALL ACTIVE QUEST NODES
                </p>
            </div>
        </div>
        <div>
            <x-pixel-button variant="gold" size="lg" href="{{ route('admin.quests.create') }}" icon="add_box">
                FORGE QUEST
            </x-pixel-button>
        </div>
    </div>

    @if($quests->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">search_off</span>
            <p class="font-headline text-[0.8rem] text-surface-variant uppercase tracking-widest mt-2">DATABASE EMPTY</p>
            <p class="font-body text-lg text-on-surface-variant mt-4">No quests have been forged yet.</p>
        </x-pixel-card>
    @else
        <x-pixel-card variant="low" padding="sm" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b-4 border-black">
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">GUILD & SUBJECT</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">QUEST NODE</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase text-center hidden md:table-cell">ORDER & XP</th>
                        <th class="p-4 font-headline text-[0.6rem] text-primary-container uppercase text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quests as $quest)
                        <tr class="border-b-2 border-surface-container hover:bg-surface-container transition-colors text-on-surface h-16 group">
                            {{-- Parents --}}
                            <td class="p-4 w-1/3">
                                <div class="flex flex-col gap-1 items-start">
                                    <span class="font-headline text-[0.55rem] bg-surface-container-highest border border-surface-variant/30 px-2 py-0.5 uppercase text-surface-variant shadow-[1px_1px_0_0_#000] truncate max-w-[150px] md:max-w-[200px] inline-block" title="{{ $quest->subject->classroom->name ?? 'NO GUILD' }}">
                                        {{ $quest->subject->classroom->name ?? 'NO GUILD' }}
                                    </span>
                                    <span class="font-headline text-[0.65rem] bg-background border border-primary-container/50 px-2 py-1 uppercase text-primary-container shadow-[2px_2px_0_0_#000] truncate max-w-[150px] md:max-w-[200px] inline-block" title="{{ $quest->subject->name ?? 'NO SUBJECT' }}">
                                        {{ $quest->subject->name ?? 'NO SUBJECT' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Quest Title --}}
                            <td class="p-4 w-1/3">
                                <div class="font-body text-lg font-bold text-primary-container truncate max-w-[150px] md:max-w-xs" title="{{ $quest->title }}">{{ $quest->title }}</div>
                                <div class="font-body text-xs text-surface-variant truncate max-w-[200px]" title="{{ $quest->description }}">
                                    {{ $quest->description ?: 'No description' }}
                                </div>
                            </td>

                            {{-- Stats --}}
                            <td class="p-4 text-center hidden md:table-cell w-1/6">
                                <span class="font-headline text-[0.7rem] bg-surface-container-lowest px-2 py-1 uppercase text-on-surface border border-surface-variant/30 mr-2">
                                    SEQ: {{ $quest->order }}
                                </span>
                                <span class="font-headline text-[0.7rem] bg-[#ffd700]/10 border border-[#ffd700]/50 px-2 py-1 uppercase text-[#ffd700]">
                                    {{ $quest->xp_reward }} XP
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="p-4 text-right w-1/6">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.quests.edit', $quest) }}" class="text-[#ffd700] hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-2xl drop-shadow-[1px_1px_0_#000]" style="font-variation-settings: 'FILL' 1;">edit_square</span>
                                    </a>
                                    <form action="{{ route('admin.quests.destroy', $quest) }}" method="POST" class="inline" onsubmit="return confirm('WARNING: DELETING THIS QUEST WILL DESTROY ALL ITS ASSOCIATED LORE MEMORY AND ENEMIES. PROCEED?');">
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
