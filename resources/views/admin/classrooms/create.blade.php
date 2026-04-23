@extends('layouts.admin')

@section('title', 'Create Guild')

@section('main')
<div class="max-w-2xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.classrooms.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT CREATION
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-primary-container">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">add_business</span>
            <h1 class="font-headline text-xl text-on-surface uppercase">ESTABLISH NEW GUILD</h1>
        </div>

        <form method="POST" action="{{ route('admin.classrooms.store') }}" class="space-y-6">
            @csrf

            {{-- Guild Name --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">fort</span> Guild Interface Name
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                       placeholder="e.g., Mathematics 101 - The Arithmancers">
                @error('name') 
                    <div class="flex items-center gap-1 mt-1 text-error">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">warning</span>
                        <p class="font-headline text-[0.55rem] uppercase">{{ $message }}</p> 
                    </div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">notes</span> Guild Codex (Description)
                </label>
                <textarea name="description" rows="4"
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant resize-y" 
                          placeholder="Detail the purpose of this guild... Optional.">{{ old('description') }}</textarea>
            </div>

            {{-- Visibility --}}
            <div class="space-y-3">
                <label class="block font-headline text-[0.7rem] text-primary-container uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">visibility</span> Guild Access Mode
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Private Option --}}
                    <label class="cursor-pointer group">
                        <input type="radio" name="visibility" value="private" class="hidden peer" {{ old('visibility', 'private') === 'private' ? 'checked' : '' }}>
                        <div class="bg-surface-container-lowest border-4 border-black p-4 flex items-start gap-3 transition-all peer-checked:border-error peer-checked:bg-error-container/10 peer-checked:shadow-[4px_4px_0_0_#000] hover:bg-surface-container">
                            <div class="w-8 h-8 border-2 border-black flex items-center justify-center flex-shrink-0 peer-checked:bg-error bg-surface-container-high">
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
                        <input type="radio" name="visibility" value="public" class="hidden peer" {{ old('visibility') === 'public' ? 'checked' : '' }}>
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

            {{-- Info Alert --}}
            <div class="bg-surface-container border-l-8 border-secondary-container p-4 flex items-start gap-3 my-8">
                <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">info</span>
                <div>
                    <h4 class="font-headline text-[0.6rem] text-secondary-container uppercase mb-1">SYSTEM NOTE</h4>
                    <p class="font-body text-lg text-on-surface-variant">A 6-character encrypted <span class="text-white font-headline tracking-widest text-[0.6rem]">JOIN CODE</span> will be auto-generated by the system upon creation. You can distribute this to your players.</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.classrooms.index') }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="gold" type="submit" size="lg" icon="keyboard_double_arrow_right" class="sm:flex-1">
                    EXECUTE_CREATION
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
