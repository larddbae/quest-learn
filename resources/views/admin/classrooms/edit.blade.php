@extends('layouts.admin')

@section('title', 'Edit Guild')

@section('main')
<div class="max-w-2xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.classrooms.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT MODIFICATION
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-gold">
        <div class="flex items-center justify-between mb-8 border-b-4 border-outline-variant pb-6">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[#ffd700] text-4xl" style="font-variation-settings: 'FILL' 1;">edit_square</span>
                <h1 class="font-headline text-xl text-on-surface uppercase">MODIFY GUILD</h1>
            </div>
            
            {{-- Static Join Code Display --}}
            <div class="bg-black border-2 border-[#ffd700] px-3 py-1 text-center hidden sm:block">
                <span class="font-headline text-[0.5rem] text-[#ffd700] block mb-0.5">AUTHORIZATION KEY</span>
                <span class="font-headline text-sm text-white tracking-[0.2em]">{{ $classroom->join_code }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.classrooms.update', $classroom) }}" class="space-y-6">
            @csrf @method('PUT')

            {{-- Guild Name --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">fort</span> Guild Interface Name
                </label>
                <input type="text" name="name" value="{{ old('name', $classroom->name) }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none">
                @error('name') 
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">notes</span> Guild Codex (Description)
                </label>
                <textarea name="description" rows="4"
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none resize-y">{{ old('description', $classroom->description) }}</textarea>
            </div>

            {{-- Visibility --}}
            <div class="space-y-3">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">visibility</span> Guild Access Mode
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Private Option --}}
                    <label class="cursor-pointer group">
                        <input type="radio" name="visibility" value="private" class="hidden peer" {{ old('visibility', $classroom->visibility) === 'private' ? 'checked' : '' }}>
                        <div class="bg-surface-container-lowest border-4 border-black p-4 flex items-start gap-3 transition-all peer-checked:border-error peer-checked:bg-error-container/10 peer-checked:shadow-[4px_4px_0_0_#000] hover:bg-surface-container">
                            <div class="w-8 h-8 border-2 border-black flex items-center justify-center flex-shrink-0 bg-surface-container-high">
                                <span class="material-symbols-outlined text-error text-lg" style="font-variation-settings: 'FILL' 1;">lock</span>
                            </div>
                            <div>
                                <span class="font-headline text-[0.6rem] text-error uppercase block">PRIVATE</span>
                                <span class="font-body text-lg text-on-surface-variant">Join Code required to enter this guild.</span>
                            </div>
                        </div>
                    </label>
                    {{-- Public Option --}}
                    <label class="cursor-pointer group">
                        <input type="radio" name="visibility" value="public" class="hidden peer" {{ old('visibility', $classroom->visibility) === 'public' ? 'checked' : '' }}>
                        <div class="bg-surface-container-lowest border-4 border-black p-4 flex items-start gap-3 transition-all peer-checked:border-secondary-container peer-checked:bg-secondary-container/10 peer-checked:shadow-[4px_4px_0_0_#000] hover:bg-surface-container">
                            <div class="w-8 h-8 border-2 border-black flex items-center justify-center flex-shrink-0 bg-surface-container-high">
                                <span class="material-symbols-outlined text-secondary-container text-lg" style="font-variation-settings: 'FILL' 1;">public</span>
                            </div>
                            <div>
                                <span class="font-headline text-[0.6rem] text-secondary-container uppercase block">PUBLIC</span>
                                <span class="font-body text-lg text-on-surface-variant">Anyone can join directly from the Guild Hall.</span>
                            </div>
                        </div>
                    </label>
                </div>
                @error('visibility')
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.classrooms.index') }}" icon="close" class="sm:flex-1 text-center">
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
