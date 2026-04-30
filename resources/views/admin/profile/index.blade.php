@extends('layouts.admin')

@section('title', 'Game Master Profile')

@section('main')
<div class="max-w-4xl mx-auto pb-12">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="material-symbols-outlined text-primary-container text-4xl mt-1" style="font-variation-settings: 'FILL' 1;">badge</span>
        <h1 class="font-headline text-2xl text-on-surface uppercase tracking-wider">GAME MASTER IDENTITY</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- ID Card --}}
        <x-pixel-card variant="low" padding="lg">
            <div class="flex flex-col items-center">
                {{-- Avatar --}}
                <div class="w-32 h-32 border-4 border-black bg-surface-container-high mb-4 flex items-center justify-center pixel-shadow shadow-[4px_4px_0_0_#000] overflow-hidden">
                    @if($user->avatar && !in_array($user->avatar, ['🧙', '🧝', '🧛', '🧜', '🗡️', '']))
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-primary-container text-7xl" style="font-variation-settings: 'FILL' 1;">shield_person</span>
                    @endif
                </div>

                {{-- Title/Name --}}
                <h2 class="font-headline text-lg text-primary-container uppercase text-center mb-1">{{ $user->name }}</h2>
                <p class="font-headline text-[0.6rem] text-secondary-container uppercase mb-2 tracking-widest">GAME MASTER (ADMIN)</p>
                
                @if($user->bio)
                    <p class="font-body text-sm text-on-surface text-center mb-4 px-4 italic border-l-2 border-surface-variant line-clamp-3">"{{ $user->bio }}"</p>
                @endif

                <div class="mb-4 mt-2">
                    <button type="button" onclick="document.getElementById('edit-profile-modal').classList.remove('hidden')" class="bg-primary hover:bg-primary/90 text-on-primary font-headline text-[0.6rem] uppercase tracking-wider px-4 py-2 border-2 border-black shadow-[2px_2px_0_0_#000] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-0.5 transition-all active:translate-y-0 active:shadow-none">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">edit</span> EDIT PROFILE
                        </span>
                    </button>
                </div>
            </div>
        </x-pixel-card>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div id="edit-profile-modal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4">
    <div class="bg-surface border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-lg overflow-hidden relative">
        <div class="bg-primary px-4 py-3 border-b-4 border-black flex justify-between items-center">
            <h3 class="font-headline text-on-primary text-lg uppercase tracking-widest">EDIT IDENTITY</h3>
            <button type="button" onclick="document.getElementById('edit-profile-modal').classList.add('hidden')" class="text-on-primary hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 bg-surface-container">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block font-headline text-[0.6rem] text-on-surface uppercase mb-2">Game Master Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-background border-2 border-black p-3 font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-[inset_2px_2px_0_rgba(0,0,0,0.1)]">
                </div>

                <div>
                    <label class="block font-headline text-[0.6rem] text-on-surface uppercase mb-2">Biography</label>
                    <textarea name="bio" rows="3" class="w-full bg-background border-2 border-black p-3 font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-[inset_2px_2px_0_rgba(0,0,0,0.1)] placeholder-surface-variant" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div>
                    <label class="block font-headline text-[0.6rem] text-on-surface uppercase mb-2">Choose Avatar</label>
                    <input type="file" name="avatar" accept="image/*" class="pixel-input text-sm p-2">
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="document.getElementById('edit-profile-modal').classList.add('hidden')" class="bg-surface-variant text-on-surface-variant font-headline text-[0.65rem] uppercase px-4 py-2 border-2 border-black hover:-translate-y-0.5 hover:shadow-[2px_2px_0_0_#000] transition-all">CANCEL</button>
                    <button type="submit" class="bg-primary text-on-primary font-headline text-[0.65rem] uppercase px-6 py-2 border-2 border-black hover:-translate-y-0.5 hover:shadow-[2px_2px_0_0_#000] transition-all">SAVE CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
