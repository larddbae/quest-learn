@extends('layouts.admin')

@section('title', 'Edit Subject')

@section('main')
<div class="max-w-2xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.subjects.index', $classroom) }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT MODIFICATION
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-gold">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-[#ffd700] text-4xl" style="font-variation-settings: 'FILL' 1;">edit_square</span>
            <h1 class="font-headline text-xl text-on-surface uppercase">MODIFY SUBJECT DB</h1>
        </div>

        <form method="POST" action="{{ route('admin.subjects.update', [$classroom, $subject]) }}" class="space-y-6">
            @csrf @method('PUT')

            {{-- Subject Name --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">menu_book</span> Subject Core Name
                </label>
                <input type="text" name="name" value="{{ old('name', $subject->name) }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none">
                @error('name') 
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">notes</span> Codex (Description)
                </label>
                <textarea name="description" rows="4"
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none resize-y">{{ old('description', $subject->description) }}</textarea>
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.subjects.index', $classroom) }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="gold" type="submit" size="lg" icon="save" class="sm:flex-1">
                    COMMIT_CHANGES
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
