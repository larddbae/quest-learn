@extends('layouts.admin')

@section('title', 'Forge Badge')

@section('main')
<div class="max-w-3xl mx-auto pb-12">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.badges.index') }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            ABORT FORGING
        </a>
    </div>

    {{-- Form Container --}}
    <x-pixel-card variant="low" padding="xl" class="border-t-8 border-t-gold">
        <div class="flex items-center gap-3 mb-8 border-b-4 border-outline-variant pb-6">
            <span class="material-symbols-outlined text-[#ffd700] text-4xl" style="font-variation-settings: 'FILL' 1;">add_reaction</span>
            <h1 class="font-headline text-xl text-on-surface uppercase">MINT NEW BADGE</h1>
        </div>

        <form method="POST" action="{{ route('admin.badges.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Badge Name --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">workspace_premium</span> Badge Identity (Name)
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none placeholder:text-surface-variant"
                       placeholder="e.g., The First Strike">
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
                    <span class="material-symbols-outlined text-sm">notes</span> Lore / Requirements (Description)
                </label>
                <textarea name="description" rows="3" required
                          class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] transition-colors outline-none placeholder:text-surface-variant resize-y" 
                          placeholder="What epic feat must a player achieve to earn this?">{{ old('description') }}</textarea>
            </div>

            {{-- Logic / Requirements Grid --}}
            <div class="bg-surface-container-high border-4 border-black p-6 space-y-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-primary-container/5 dithered-bg pointer-events-none opacity-50"></div>
                
                <h3 class="font-headline text-[0.6rem] text-primary-container uppercase relative z-10 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">data_object</span> System Requirements
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10">
                    <div>
                        <label class="block font-headline text-[0.6rem] text-on-surface uppercase mb-2">CRITERIA TYPE</label>
                        <select name="criteria_type" required 
                                class="w-full bg-surface-container-lowest border-4 border-black p-3 text-on-surface font-body text-xl focus:ring-0 focus:border-[#ffd700] outline-none appearance-none cursor-pointer">
                            <option value="quests_completed" {{ old('criteria_type') === 'quests_completed' ? 'selected' : '' }}>Quests Completed</option>
                            <option value="perfect_score" {{ old('criteria_type') === 'perfect_score' ? 'selected' : '' }}>Perfect Scores</option>
                            <option value="xp_earned" {{ old('criteria_type') === 'xp_earned' ? 'selected' : '' }}>XP Earned</option>
                            <option value="level_reached" {{ old('criteria_type') === 'level_reached' ? 'selected' : '' }}>Level Reached</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-headline text-[0.6rem] text-on-surface uppercase mb-2">TARGET VALUE (N)</label>
                        <input type="number" name="criteria_value" value="{{ old('criteria_value', 1) }}" required min="1"
                               class="w-full bg-surface-container-lowest border-4 border-black p-3 text-primary-container font-headline focus:ring-0 focus:border-[#ffd700] outline-none">
                    </div>
                </div>
            </div>

            {{-- File Upload --}}
            <div class="space-y-2">
                <label class="block font-headline text-[0.7rem] text-[#ffd700] uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">image</span> Custom Sprite (Icon PNG)
                </label>
                <div class="relative bg-surface-container-lowest border-4 border-black p-6 hover:bg-surface-container transition-colors group">
                    <input type="file" name="icon" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="flex flex-col items-center justify-center text-center">
                        <span class="material-symbols-outlined text-surface-variant text-4xl mb-2 group-hover:text-primary-container group-hover:animate-bounce transition-colors">cloud_upload</span>
                        <p class="font-headline text-[0.6rem] text-on-surface mb-1">CLICK OR DRAG PIXEL IMAGE HERE</p>
                        <p class="font-body text-sm text-on-surface-variant">Recommended 64x64 PNG. Max 2MB. Optional.</p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-6 border-t-4 border-outline-variant flex flex-col sm:flex-row gap-4 justify-end mt-8">
                <x-pixel-button variant="ghost" size="lg" href="{{ route('admin.badges.index') }}" icon="close" class="sm:flex-1 text-center">
                    CANCEL
                </x-pixel-button>
                <x-pixel-button variant="gold" type="submit" size="lg" icon="hardware" class="sm:flex-1">
                    FORGE_BADGE
                </x-pixel-button>
            </div>
        </form>
    </x-pixel-card>
</div>
@endsection
