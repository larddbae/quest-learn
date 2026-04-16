@extends('layouts.admin')

@section('title', 'Guild Management')

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">fort</span>
            <div>
                <h1 class="font-headline text-2xl text-on-surface uppercase">GUILD COMMAND</h1>
                <p class="font-body text-lg text-on-surface-variant mt-1">Manage active classrooms and player rosters</p>
            </div>
        </div>
        <x-pixel-button variant="gold" size="md" href="{{ route('admin.classrooms.create') }}" icon="add_business">
            ESTABLISH NEW GUILD
        </x-pixel-button>
    </div>

    {{-- Guilds List --}}
    @forelse($classrooms as $classroom)
        <x-pixel-card variant="low" padding="md" class="mb-6 hover:-translate-y-1 transition-transform">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                
                {{-- Guild Info --}}
                <div class="flex-1">
                    <h3 class="font-headline text-lg text-primary-container uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">school</span>
                        {{ $classroom->name }}
                    </h3>
                    <p class="font-body text-xl text-on-surface-variant mb-4 max-w-2xl">
                        {{ $classroom->description ?? 'No description provided.' }}
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-4">
                        {{-- Secret Join Code --}}
                        <div class="bg-black border-4 border-primary-container px-4 py-2 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary-container text-lg">key</span>
                            <div class="flex flex-col">
                                <span class="font-headline text-[0.55rem] text-surface-variant uppercase">ACCESS_CODE</span>
                                <span class="font-headline text-lg text-primary-container tracking-[0.3em]">{{ $classroom->join_code }}</span>
                            </div>
                        </div>

                        {{-- Player Count --}}
                        <div class="bg-surface-container border-2 border-black px-3 py-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary-container text-lg">group</span>
                            <span class="font-headline text-[0.65rem] text-on-surface uppercase">{{ $classroom->students_count }} ACTIVE PLAYERS</span>
                        </div>
                    </div>
                </div>

                {{-- Admin Actions --}}
                <div class="flex flex-wrap md:flex-col lg:flex-row items-center gap-3 border-t-4 md:border-t-0 md:border-l-4 border-outline-variant pt-4 md:pt-0 md:pl-6">
                    <x-pixel-button variant="blue" size="sm" href="{{ route('admin.classrooms.show', $classroom) }}" icon="monitor_heart">
                        MONITOR
                    </x-pixel-button>
                    <x-pixel-button variant="green" size="sm" href="{{ route('admin.subjects.index', $classroom) }}" icon="menu_book">
                        SUBJECTS
                    </x-pixel-button>
                    <x-pixel-button variant="gold" size="sm" href="{{ route('admin.classrooms.edit', $classroom) }}" icon="edit">
                        EDIT
                    </x-pixel-button>
                    
                    <form method="POST" action="{{ route('admin.classrooms.destroy', $classroom) }}" class="inline"
                          onsubmit="return confirm('WARNING: Purge this guild? All player progress and data will be permanently deleted!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-surface-container-lowest border-4 border-error text-error hover:bg-error hover:text-white p-2 flex items-center justify-center transition-colors shadow-[4px_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 active:translate-x-1" title="PURGE GUILD">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </button>
                    </form>
                </div>

            </div>
        </x-pixel-card>
    @empty
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-8xl mb-6">domain_disabled</span>
            <h2 class="font-headline text-lg text-primary-container mb-2 uppercase">NO GUILDS ESTABLISHED</h2>
            <p class="font-body text-xl text-on-surface-variant mb-6">You have not forged any guilds yet. Start by establishing your first classroom.</p>
            <x-pixel-button variant="gold" href="{{ route('admin.classrooms.create') }}" icon="add">
                CREATE FIRST GUILD
            </x-pixel-button>
        </x-pixel-card>
    @endempty
</div>
@endsection
