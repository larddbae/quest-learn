@extends('layouts.admin')

@section('title', 'Manage Materials (Lore)')

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Arcade Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="mb-4 md:mb-0 text-center md:text-left">
            <div class="flex items-center gap-3 justify-center md:justify-start">
                <span class="material-symbols-outlined text-secondary-container text-5xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                <h1 class="font-headline text-3xl text-secondary-container pixel-glow uppercase tracking-widest">
                    LORE LIBRARY
                </h1>
            </div>
            <div class="inline-block bg-background border-2 border-secondary-container px-6 py-2 mt-4 text-center">
                <p class="font-headline text-[0.7rem] text-primary-container uppercase tracking-wider">
                    GLOBAL ARCHIVE OF ALL QUEST LORE MEMORIES
                </p>
            </div>
        </div>
        <div>
            <x-pixel-button variant="blue" size="lg" href="{{ route('admin.materials.create') }}" icon="publish">
                AUTHOR LORE
            </x-pixel-button>
        </div>
    </div>

    @if($materials->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">search_off</span>
            <p class="font-headline text-[0.8rem] text-surface-variant uppercase tracking-widest mt-2">ARCHIVE EMPTY</p>
            <p class="font-body text-lg text-on-surface-variant mt-4">No lore materials have been authored yet.</p>
        </x-pixel-card>
    @else
        <x-pixel-card variant="low" padding="sm" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b-4 border-black">
                        <th class="p-4 font-headline text-[0.6rem] text-gray-200 uppercase">PARENT HIERARCHY</th>
                        <th class="p-4 font-headline text-[0.6rem] text-gray-200 uppercase">LORE MATERIAL</th>
                        <th class="p-4 font-headline text-[0.6rem] text-gray-200 uppercase text-center hidden md:table-cell">MEDIA</th>
                        <th class="p-4 font-headline text-[0.6rem] text-gray-200 uppercase text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                        <tr class="border-b-2 border-surface-container hover:bg-surface-container transition-colors text-on-surface h-16 group">
                            {{-- Parents --}}
                            <td class="p-4 w-1/3">
                                <div class="flex flex-col gap-1 items-start">
                                    <div class="flex items-center gap-1">
                                        <span class="font-headline text-[0.5rem] bg-surface-container-highest border border-surface-variant/30 px-1.5 py-0.5 uppercase text-gray-300">
                                            {{ $material->quest->subject->classroom->name ?? 'NO GUILD' }}
                                        </span>
                                        <span class="material-symbols-outlined text-[0.6rem] text-gray-400">chevron_right</span>
                                        <span class="font-headline text-[0.55rem] bg-surface-container-highest border border-surface-variant/30 px-1.5 py-0.5 uppercase text-gray-300">
                                            {{ $material->quest->subject->name ?? 'NO SUBJECT' }}
                                        </span>
                                    </div>
                                    <span class="font-headline text-[0.65rem] bg-background border border-primary-container/50 px-2 py-1 uppercase text-gray-200 shadow-[2px_2px_0_0_#000] mt-1">
                                        {{ $material->quest->title ?? 'NO QUEST' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Material Title --}}
                            <td class="p-4 w-1/3">
                                <div class="font-body text-lg font-bold text-white">{{ $material->title }}</div>
                                <div class="font-body text-xs text-gray-300 truncate max-w-[200px]" title="{{ strip_tags($material->content) }}">
                                    {{ Str::limit(strip_tags($material->content), 30) }}
                                </div>
                            </td>

                            {{-- Media Details --}}
                            <td class="p-4 text-center hidden md:table-cell w-1/6">
                                @if($material->video_url)
                                    <a href="{{ $material->video_url }}" target="_blank" class="inline-flex items-center gap-1 text-[0.65rem] font-headline bg-blue-900/40 text-blue-300 border border-blue-500/50 px-2 py-1 uppercase hover:bg-blue-800/60 transition-colors">
                                        <span class="material-symbols-outlined text-sm">smart_display</span> PLAY VIDEO
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[0.6rem] font-headline text-surface-variant uppercase">
                                        <span class="material-symbols-outlined text-sm">history_edu</span> TEXT ONLY
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="p-4 text-right w-1/6">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.materials.edit', $material) }}" class="text-[#ffd700] hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-2xl drop-shadow-[1px_1px_0_#000]" style="font-variation-settings: 'FILL' 1;">edit_square</span>
                                    </a>
                                    <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="inline" onsubmit="return confirm('WARNING: DELETING THIS LORE MATERIAL WILL ALSO DELETE ANY ASSOCIATED QUIZ ENEMIES TRACED TO IT. PROCEED?');">
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
