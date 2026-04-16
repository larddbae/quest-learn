@extends('layouts.admin')

@section('title', 'Quests — ' . $subject->name)

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.subjects.index', $subject->classroom) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            {{ $subject->name }}
        </a>
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">swords</span>
            <div>
                <h1 class="font-headline text-2xl text-on-surface uppercase">QUEST ARCHIVE</h1>
                <p class="font-body text-lg text-on-surface-variant mt-1">Manage skill nodes for {{ $subject->name }}</p>
            </div>
        </div>
        <x-pixel-button variant="gold" size="md" href="{{ route('admin.quests.create', $subject) }}" icon="add_box">
            ADD NEW QUEST
        </x-pixel-button>
    </div>

    {{-- Quests List / Timeline --}}
    @forelse($quests as $quest)
        <x-pixel-card variant="low" padding="md" class="mb-6 hover:-translate-y-1 transition-transform relative">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                
                {{-- Quest Details (Left) --}}
                <div class="flex-1 flex gap-4">
                    {{-- Order Number Box --}}
                    <div class="flex-shrink-0 w-16 h-16 bg-surface-container-high border-4 border-black flex flex-col items-center justify-center text-center">
                        <span class="font-headline text-[0.55rem] text-surface-variant uppercase mb-1">NODE</span>
                        <span class="font-headline text-lg text-primary-container">{{ $quest->order }}</span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <h3 class="font-headline text-lg text-on-surface uppercase tracking-wider mb-2">
                            {{ $quest->title }}
                        </h3>
                        <p class="font-body text-xl text-on-surface-variant mb-4 max-w-2xl line-clamp-2">
                            {{ $quest->description ?? 'No description provided.' }}
                        </p>
                        
                        {{-- Meta Tags --}}
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="bg-surface-container-high border-2 border-primary-container inline-flex items-center gap-2 px-2 py-1">
                                <span class="material-symbols-outlined text-primary-container text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-headline text-[0.65rem] text-primary-container uppercase">{{ $quest->xp_reward }} XP</span>
                            </div>
                            
                            @if($quest->material)
                                <div class="bg-surface-container inline-flex items-center gap-2 px-2 py-1 border-2 border-black">
                                    <span class="material-symbols-outlined text-secondary-container text-sm">auto_stories</span>
                                    <span class="font-headline text-[0.65rem] text-secondary-container uppercase">LORE ATTACHED</span>
                                </div>
                                <div class="bg-surface-container inline-flex items-center gap-2 px-2 py-1 border-2 border-black">
                                    <span class="material-symbols-outlined text-error text-sm">crisis_alert</span>
                                    <span class="font-headline text-[0.65rem] text-error uppercase">{{ $quest->material->quizzes->count() }} ENEMIES</span>
                                </div>
                            @else
                                <div class="bg-surface-container-lowest inline-flex items-center gap-2 px-2 py-1 border-2 border-surface-variant text-surface-variant">
                                    <span class="material-symbols-outlined text-sm">warning</span>
                                    <span class="font-headline text-[0.65rem] uppercase">EMPTY NODE WARNING</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Panel (Right) --}}
                <div class="flex flex-wrap md:flex-col lg:flex-row items-center gap-3 border-t-4 md:border-t-0 md:border-l-4 border-outline-variant pt-4 md:pt-0 md:pl-6">
                    @if($quest->material)
                         <x-pixel-button variant="blue" size="sm" href="{{ route('admin.materials.edit', $quest) }}" icon="menu_book">
                            LORE
                        </x-pixel-button>
                    @else
                        <x-pixel-button variant="green" size="sm" href="{{ route('admin.materials.create', $quest) }}" icon="post_add">
                            ADD_LORE
                        </x-pixel-button>
                    @endif
                    
                    <x-pixel-button variant="purple" size="sm" href="{{ route('admin.quizzes.index', $quest) }}" icon="swords">
                        ENEMIES
                    </x-pixel-button>
                    
                    <x-pixel-button variant="gold" size="sm" href="{{ route('admin.quests.edit', [$subject, $quest]) }}" icon="edit">
                        EDIT
                    </x-pixel-button>

                    <form method="POST" action="{{ route('admin.quests.destroy', [$subject, $quest]) }}" class="inline"
                          onsubmit="return confirm('WARNING: Destroy this node? All lore and enemies heavily bound to it will perish.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-surface-container-lowest border-4 border-error text-error hover:bg-error hover:text-white p-2 flex items-center justify-center transition-colors shadow-[4px_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 active:translate-x-1" title="DESTROY NODE">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </button>
                    </form>
                </div>
            </div>
        </x-pixel-card>
    @empty
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-7xl mb-4">account_tree</span>
            <p class="font-headline text-lg text-primary-container mb-2 uppercase">NO QUEST NODES DETECTED</p>
            <p class="font-body text-xl text-on-surface-variant mb-6 mx-auto max-w-md">This subject contains no structured missions. Expand the skill tree by adding your first quest node.</p>
            <x-pixel-button variant="gold" href="{{ route('admin.quests.create', $subject) }}" icon="add">
                FORGE FIRST QUEST
            </x-pixel-button>
        </x-pixel-card>
    @endforelse
</div>
@endsection
