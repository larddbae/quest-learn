@extends('layouts.admin')

@section('title', 'Badge Forge')

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
            <div>
                <h1 class="font-headline text-2xl text-on-surface uppercase">BADGE FORGE</h1>
                <p class="font-body text-lg text-on-surface-variant mt-1">Design and mint collectible achievements</p>
            </div>
        </div>
        <x-pixel-button variant="gold" size="md" href="{{ route('admin.badges.create') }}" icon="add_reaction">
            FORGE NEW BADGE
        </x-pixel-button>
    </div>

    @if($badges->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-8xl mb-6">hardware</span>
            <h2 class="font-headline text-lg text-primary-container mb-4 uppercase">FORGE IS COLD</h2>
            <p class="font-body text-xl text-on-surface-variant mb-6 max-w-md mx-auto">You have not minted any badges yet. Ignite the forge to create collectible achievements for your players.</p>
            <x-pixel-button variant="gold" href="{{ route('admin.badges.create') }}" icon="local_fire_department">
                IGNITE FORGE
            </x-pixel-button>
        </x-pixel-card>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($badges as $badge)
                <x-pixel-card variant="low" padding="md" class="hover:-translate-y-1 transition-transform flex flex-col h-full group">
                    {{-- Badge Display --}}
                    <div class="bg-surface-container-high border-4 border-black p-6 mb-4 flex items-center justify-center relative overflow-hidden h-40">
                        {{-- Background Glow --}}
                        <div class="absolute inset-0 bg-primary-container/5 rounded-full blur-2xl group-hover:bg-primary-container/20 transition-colors"></div>
                        
                        @if($badge->icon_path)
                            <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->name }}" class="w-16 h-16 object-contain relative z-10 drop-shadow-[2px_2px_0_rgba(0,0,0,1)] group-hover:scale-110 transition-transform">
                        @else
                            <span class="text-6xl relative z-10 drop-shadow-[4px_4px_0_rgba(0,0,0,1)] group-hover:scale-110 transition-transform">🏅</span>
                        @endif
                    </div>

                    {{-- Info --}}
                    <h3 class="font-headline text-sm text-primary-container uppercase text-center mb-2 line-clamp-2">{{ $badge->name }}</h3>
                    <p class="font-body text-lg text-on-surface-variant text-center mb-4 line-clamp-3 flex-grow">{{ $badge->description }}</p>

                    {{-- Criteria Type Box --}}
                    <div class="bg-background border-2 border-primary-container text-center py-2 mb-6">
                        <span class="font-headline text-[0.55rem] text-surface-variant uppercase block mb-1">REQUIREMENT</span>
                        <span class="font-headline text-[0.65rem] text-secondary-container uppercase">
                            {{ str_replace('_', ' ', $badge->criteria_type) }} <span class="text-white">≥ {{ $badge->criteria_value }}</span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <x-pixel-button variant="gold" size="sm" href="{{ route('admin.badges.edit', $badge) }}" icon="edit" class="text-center justify-center">
                            EDIT
                        </x-pixel-button>
                        
                        <form method="POST" action="{{ route('admin.badges.destroy', $badge) }}" class="inline"
                              onsubmit="return confirm('Melt down this badge? It will be removed from all player inventories!')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-surface-container-lowest border-4 border-error text-error hover:bg-error hover:text-white p-2 flex items-center justify-center transition-colors shadow-[4px_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 active:translate-x-1" title="MELT BADGE">
                                <span class="material-symbols-outlined text-sm">delete</span> 
                                <span class="font-headline text-[0.6rem] uppercase ml-1 block sm:hidden lg:block">DEL</span>
                            </button>
                        </form>
                    </div>
                </x-pixel-card>
            @endforeach
        </div>
    @endif
</div>
@endsection
