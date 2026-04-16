@extends('layouts.admin')

@section('title', 'Subjects — ' . $classroom->name)

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.classrooms.show', $classroom) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            {{ $classroom->name }}
        </a>
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
            <div>
                <h1 class="font-headline text-2xl text-on-surface uppercase">SUBJECTS DB</h1>
                <p class="font-body text-lg text-on-surface-variant mt-1">Manage skill trees for {{ $classroom->name }}</p>
            </div>
        </div>
        <x-pixel-button variant="gold" size="md" href="{{ route('admin.subjects.create', $classroom) }}" icon="library_add">
            ADD SUBJECT
        </x-pixel-button>
    </div>

    {{-- Subject List --}}
    @forelse($subjects as $subject)
        <x-pixel-card variant="low" padding="md" class="mb-6 hover:-translate-y-1 transition-transform">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                
                {{-- Subject Info --}}
                <div class="flex-1">
                    @php
                        $subjectIcons = [
                            'science' => 'science',
                            'math' => 'calculate',
                            'history' => 'history_edu',
                            'english' => 'local_library',
                        ];
                        $icon = $subjectIcons[strtolower($subject->name)] ?? 'explore';
                    @endphp

                    <h3 class="font-headline text-lg text-primary-container uppercase tracking-wider mb-2 flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
                        {{ $subject->name }}
                    </h3>
                    <p class="font-body text-xl text-on-surface-variant mb-4 max-w-2xl">
                        {{ $subject->description ?? 'No description provided.' }}
                    </p>
                    
                    <div class="bg-surface-container border-2 border-black inline-flex items-center gap-2 px-3 py-1">
                        <span class="material-symbols-outlined text-primary-container text-sm">map</span>
                        <span class="font-headline text-[0.65rem] text-on-surface uppercase">{{ $subject->quests_count }} QUESTS LOADED</span>
                    </div>
                </div>

                {{-- Admin Actions --}}
                <div class="flex flex-wrap md:flex-col lg:flex-row items-center gap-3 border-t-4 md:border-t-0 md:border-l-4 border-outline-variant pt-4 md:pt-0 md:pl-6">
                    <x-pixel-button variant="green" size="md" href="{{ route('admin.quests.index', $subject) }}" icon="swords">
                        MANAGE QUESTS
                    </x-pixel-button>
                    <x-pixel-button variant="gold" size="md" href="{{ route('admin.subjects.edit', [$classroom, $subject]) }}" icon="edit">
                        EDIT
                    </x-pixel-button>
                    
                    <form method="POST" action="{{ route('admin.subjects.destroy', [$classroom, $subject]) }}" class="inline"
                          onsubmit="return confirm('WARNING: Purge this subject? All associated quests and materials will be deleted!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-surface-container-lowest border-4 border-error text-error hover:bg-error hover:text-white p-3 flex items-center justify-center transition-colors shadow-[4px_4px_0_0_#991b1b] active:shadow-none active:translate-y-1 active:translate-x-1" title="PURGE SUBJECT">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </button>
                    </form>
                </div>
            </div>
        </x-pixel-card>
    @empty
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-7xl mb-4">auto_stories</span>
            <p class="font-headline text-lg text-primary-container mb-2 uppercase">NO SUBJECTS ESTABLISHED</p>
            <p class="font-body text-xl text-on-surface-variant mb-6 relative z-10">There are no learning paths generated for this guild's players yet.</p>
            <div class="relative z-10 inline-block">
                <x-pixel-button variant="gold" href="{{ route('admin.subjects.create', $classroom) }}" icon="add">
                    CREATE FIRST SUBJECT
                </x-pixel-button>
            </div>
        </x-pixel-card>
    @endforelse
</div>
@endsection
