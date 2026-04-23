@extends('layouts.student')

@section('title', 'Profile & Inventory')

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="material-symbols-outlined text-primary-container text-4xl mt-1" style="font-variation-settings: 'FILL' 1;">badge</span>
        <h1 class="font-headline text-2xl text-on-surface uppercase tracking-wider">PLAYER IDENTITY & INVENTORY</h1>
    </div>

    <div class="grid grid-cols-12 gap-6">
        {{-- ============================================
             LEFT COLUMN: Player ID Card & Stats
             ============================================ --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">
            {{-- ID Card --}}
            <x-pixel-card variant="low" padding="lg">
                <div class="flex flex-col items-center">
                    {{-- Avatar --}}
                    <div class="w-32 h-32 border-4 border-black bg-surface-container-high mb-4 flex items-center justify-center pixel-shadow shadow-[4px_4px_0_0_#000]">
                        @if($user->avatar && !in_array($user->avatar, ['🧙', '🧝', '🧛', '🧜', '']))
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <div class="text-7xl animate-float">{{ $user->avatar ?? '🧙' }}</div>
                        @endif
                    </div>

                    {{-- Title/Name --}}
                    <h2 class="font-headline text-lg text-primary-container uppercase text-center mb-1">{{ $user->name }}</h2>
                    <p class="font-headline text-[0.6rem] text-secondary-container uppercase mb-4 tracking-widest">{{ $user->activeClassroom()->name ?? 'No Guild Assigned' }}</p>

                    {{-- Rank & Level Badges --}}
                    <div class="flex gap-4 w-full">
                        <div class="flex-1 bg-surface-container border-2 border-black text-center py-2 flex flex-col items-center justify-center">
                            <span class="font-headline text-[0.55rem] text-surface-variant uppercase mb-1">LEVEL</span>
                            <span class="font-headline text-lg text-primary-container">{{ $user->level }}</span>
                        </div>
                        <div class="flex-1 bg-surface-container border-2 border-black text-center py-2 flex flex-col items-center justify-center relative overflow-hidden">
                            <span class="absolute right-0 top-0 text-3xl opacity-10 -mr-2 -mt-2">🏅</span>
                            <span class="font-headline text-[0.55rem] text-surface-variant uppercase mb-1">RANK</span>
                            <span class="font-headline text-[0.6rem] text-secondary-container rank-badge rank-{{ strtolower($user->rank) }} leading-tight">
                                {{ $user->rank }}
                            </span>
                        </div>
                    </div>
                </div>
            </x-pixel-card>

            {{-- Stat Grid --}}
            <div class="grid grid-cols-2 gap-4">
                <x-stat-card label="QUESTS_DONE" :value="$completedQuests" icon="swords" color="gold" />
                <x-stat-card label="TOTAL_XP" :value="number_format($totalXP)" icon="star" color="blue" />
                <x-stat-card label="PERFECT_RUNS" :value="$perfectScores" icon="crisis_alert" color="green" />
                <x-stat-card label="BADGES_OWNED" :value="$badges->count()" icon="workspace_premium" color="gold" />
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-pixel-button variant="red" type="submit" :full="true" icon="logout" size="sm">
                    DISCONNECT (LOGOUT)
                </x-pixel-button>
            </form>
        </div>

        {{-- ============================================
             RIGHT COLUMN: Inventory & Bookmarks
             ============================================ --}}
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            
            {{-- Badge Inventory Screen --}}
            <x-pixel-card variant="low" padding="md" class="flex-1">
                <div class="flex items-center gap-3 mb-6 border-b-4 border-black pb-4">
                    <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">backpack</span>
                    <h3 class="font-headline text-sm text-on-surface uppercase">COLLECTION INVENTORY</h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    {{-- Earned Badges --}}
                    @forelse($badges as $badge)
                        <div class="group relative">
                            <div class="bg-surface-container-high border-4 border-black p-4 aspect-square flex flex-col items-center justify-center text-center shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] hover:bg-surface-container-highest transition-all pixel-glow cursor-help">
                                @if($badge->icon_path)
                                    <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->name }}" class="w-12 h-12 object-contain mb-3 drop-shadow-[2px_2px_0_rgba(0,0,0,1)] group-hover:scale-110 transition-transform">
                                @else
                                    <span class="text-4xl mb-3 drop-shadow-[2px_2px_0_rgba(0,0,0,1)] group-hover:scale-110 transition-transform">🏅</span>
                                @endif
                                <p class="font-headline text-[0.55rem] text-primary-container uppercase leading-tight line-clamp-2">{{ $badge->name }}</p>
                            </div>
                            
                            {{-- Tooltip overlay --}}
                            <div class="absolute inset-0 bg-black/90 p-2 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-center pointer-events-none z-10">
                                <p class="font-body text-sm text-white">{{ $badge->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-8 text-center bg-surface-container border-2 border-dashed border-surface-variant flex flex-col items-center">
                            <span class="material-symbols-outlined text-surface-variant text-4xl mb-2">sentiment_dissatisfied</span>
                            <p class="font-headline text-[0.6rem] text-surface-variant uppercase">Inventory is empty.</p>
                        </div>
                    @endforelse

                    {{-- Empty Slots for aesthetic padding if < 8 badges --}}
                    @for($i = $badges->count(); $i < max($badges->count(), 8); $i++)
                        <div class="bg-background border-4 border-surface-variant p-4 aspect-square flex items-center justify-center opacity-50 grayscale select-none">
                            <span class="material-symbols-outlined text-surface-variant text-4xl">lock</span>
                        </div>
                    @endfor
                </div>
            </x-pixel-card>

            {{-- Saved Materials / Bookmarks --}}
            <x-pixel-card variant="high" padding="md">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">bookmark</span>
                    <h3 class="font-headline text-sm text-on-surface uppercase">SAVED LORE (BOOKMARKS)</h3>
                </div>

                <div class="space-y-3 max-h-[300px] overflow-y-auto custom-scrollbar pr-2">
                    @forelse($bookmarks as $bookmark)
                        <a href="{{ route('student.materials.show', $bookmark->material->quest_id) }}" class="block">
                            <div class="bg-surface-container-lowest border-2 border-black p-3 flex items-center gap-4 hover:-translate-y-0.5 hover:shadow-[2px_2px_0_0_#000] hover:bg-surface-container transition-all cursor-pointer">
                                <div class="w-10 h-10 border-2 border-black bg-surface-container-high flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-headline text-[0.65rem] text-primary-container truncate uppercase">{{ $bookmark->material->title }}</h4>
                                    <p class="font-body text-sm text-on-surface-variant truncate">
                                        {{ $bookmark->material->quest->subject->name ?? '' }} • {{ $bookmark->material->quest->title ?? '' }}
                                    </p>
                                </div>
                                <span class="material-symbols-outlined text-surface-variant hidden sm:block">arrow_forward</span>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center bg-surface-container border-2 border-dashed border-surface-variant">
                            <p class="font-headline text-[0.6rem] text-surface-variant uppercase">0 Bookmarks Saved.</p>
                        </div>
                    @endforelse
                </div>
            </x-pixel-card>
            
        </div>
    </div>
</div>
@endsection
