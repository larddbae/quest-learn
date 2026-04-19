@extends('layouts.admin')

@section('title', 'Create Material')

@section('main')
<div class="max-w-3xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.materials.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT LORE CREATION
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-secondary-container">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-secondary-container text-4xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
            <div>
                <h1 class="font-headline text-xl text-on-surface uppercase">AUTHOR LORE MATERIAL</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.materials.store') }}" class="space-y-6">
            @csrf

            {{-- Select Quest --}}
            <div class="space-y-2 relative">
                <label class="block font-headline text-[0.7rem] text-secondary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">swords</span> Target Quest Node
                </label>
                <div class="relative">
                    <select name="quest_id" required
                            class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none cursor-pointer appearance-none">
                        <option value="" disabled selected>-- SELECT QUEST --</option>
                        @foreach($quests as $qst)
                            <option value="{{ $qst->id }}" {{ old('quest_id') == $qst->id ? 'selected' : '' }}>
                                {{ $qst->subject->classroom->name }} - {{ $qst->subject->name }} - {{ $qst->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-secondary-container">
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                </div>
                @error('quest_id')
                    <div class="flex items-center gap-1 mt-1 text-error absolute -bottom-5 left-0">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Title --}}
            <div class="space-y-2 relative mt-8">
                <label class="block font-headline text-[0.7rem] text-secondary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">label</span> Material Title
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                       placeholder="e.g., Chapter 1: The Basics">
                @error('title') 
                    <div class="flex items-center gap-1 mt-1 text-error absolute -bottom-5 left-0">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Video --}}
            <div class="space-y-2 relative pt-4">
                <label class="block font-headline text-[0.7rem] text-secondary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">smart_display</span> Embed Video Link
                </label>
                <input type="url" name="video_url" value="{{ old('video_url') }}"
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                       placeholder="https://youtube.com/watch?v=...">
                <p class="font-body text-sm text-surface-variant mt-1">Leave empty if no visual log is required.</p>
            </div>

            {{-- Content --}}
            <div class="space-y-2 relative pt-4">
                <label class="block font-headline text-[0.7rem] text-secondary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">history_edu</span> Lore Content (Text)
                </label>
                <div class="bg-surface-container-high border-4 border-black p-2 flex flex-col">
                    <textarea name="content" rows="12" required
                              class="w-full bg-surface-container-lowest border-2 border-black p-4 text-on-surface font-body text-xl focus:ring-0 outline-none resize-y" 
                              placeholder="Type the learning material here. Use line breaks for paragraphs...">{{ old('content') }}</textarea>
                </div>
                @error('content') 
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.materials.index') }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="blue" type="submit" size="lg" icon="publish" class="sm:flex-1">
                    PUBLISH_LORE
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
