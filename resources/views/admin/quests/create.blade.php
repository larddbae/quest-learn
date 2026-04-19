@extends('layouts.admin')

@section('title', 'Create Quest')

@section('main')
<div class="max-w-3xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.quests.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT CREATION
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-primary-container">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">add_box</span>
            <h1 class="font-headline text-xl text-on-surface uppercase">FORGE NEW QUEST NODE</h1>
        </div>

        <form method="POST" action="{{ route('admin.quests.store') }}" class="space-y-6">
            @csrf

            {{-- Select Subject --}}
            <div class="space-y-2 relative">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">menu_book</span> Parent Subject
                </label>
                <div class="relative">
                    <select name="subject_id" required
                            class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none cursor-pointer appearance-none">
                        <option value="" disabled selected>-- SELECT SUBJECT --</option>
                        @foreach($subjects as $subj)
                            <option value="{{ $subj->id }}" {{ old('subject_id') == $subj->id ? 'selected' : '' }}>
                                {{ $subj->classroom->name }} - {{ $subj->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-primary-container">
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                </div>
                @error('subject_id')
                    <div class="flex items-center gap-1 mt-1 text-error absolute -bottom-5 left-0">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Title --}}
            <div class="space-y-2 relative mt-8">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">title</span> Quest Node Title
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                       placeholder="e.g., The Foundations of Magic">
                @error('title') 
                    <div class="flex items-center gap-1 mt-1 text-error absolute -bottom-5 left-0">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-2 mt-8">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">notes</span> Mission Briefing (Description)
                </label>
                <textarea name="description" rows="4"
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant resize-y" 
                          placeholder="Briefly describe the objective of this quest...">{{ old('description') }}</textarea>
            </div>

            {{-- Node Config Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-surface-container-high border-4 border-black p-6 relative overflow-hidden mt-6 text-on-surface">
                <div class="absolute inset-0 bg-primary-container/5 dithered-bg pointer-events-none opacity-50"></div>
                
                <h3 class="font-headline text-[0.6rem] text-primary-container uppercase relative z-10 flex items-center gap-2 md:col-span-2">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">build_circle</span> System Parameters
                </h3>

                {{-- Order --}}
                <div class="relative z-10 space-y-2">
                    <label class="block font-headline text-[0.6rem] text-on-surface uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">format_list_numbered</span> Sequence Order
                    </label>
                    <input type="number" name="order" value="{{ old('order', $nextOrder) }}" required min="0"
                           class="w-full bg-surface-container-lowest border-4 border-black p-3 text-on-surface font-headline focus:ring-0 focus:border-secondary-container outline-none">
                    <p class="font-body text-sm text-surface-variant">Positional index in the subject's timeline.</p>
                </div>

                {{-- XP --}}
                <div class="relative z-10 space-y-2">
                    <label class="block font-headline text-[0.6rem] text-primary-container uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span> XP REWARD VALUE
                    </label>
                    <input type="number" name="xp_reward" value="{{ old('xp_reward', 100) }}" required min="1"
                           class="w-full bg-surface-container-lowest border-4 border-black p-3 text-primary-container font-headline focus:ring-0 focus:border-secondary-container outline-none">
                    <p class="font-body text-sm text-surface-variant">Experience granted upon successful clearance.</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.quests.index') }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="gold" type="submit" size="lg" icon="add_box" class="sm:flex-1">
                    FORGE_QUEST_NODE
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
