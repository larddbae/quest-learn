@extends('layouts.base')

@section('title', 'QuestLearn — Level Up Your Mind')

@section('content')
{{-- Navigation Header --}}
<header class="bg-background text-primary-container font-headline uppercase tracking-wider text-[0.75rem] fixed top-0 w-full border-b-4 border-black shadow-[4px_4px_0px_0px_#000000] flex justify-between items-center px-6 py-4 z-40">
    <div class="flex items-center gap-4">
        <span class="text-xl font-bold text-primary-container tracking-tighter">QUESTLEARN</span>
    </div>
    <nav class="hidden md:flex items-center gap-8">
        <a class="text-[#3a86ff] hover:text-primary-fixed hover:translate-x-[2px] hover:translate-y-[2px] transition-all" href="#">QUESTS</a>
        <a class="text-[#3a86ff] hover:text-primary-fixed hover:translate-x-[2px] hover:translate-y-[2px] transition-all" href="#">SKILLS</a>
        <a class="text-[#3a86ff] hover:text-primary-fixed hover:translate-x-[2px] hover:translate-y-[2px] transition-all" href="#">BESTIARY</a>
    </nav>
    <div class="flex items-center gap-4">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">military_tech</span>
        <x-pixel-button variant="gold" size="sm" href="{{ route('login') }}">[ LOGIN ]</x-pixel-button>
    </div>
</header>

{{-- Hero Stage --}}
<main class="flex-grow flex flex-col items-center justify-center relative overflow-hidden px-4 pt-24 pb-32 min-h-screen">
    {{-- Background Floating Icons --}}
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
        <div class="absolute top-1/4 left-10 transform -rotate-12">
            <span class="material-symbols-outlined text-primary-container text-6xl" style="font-variation-settings: 'FILL' 1;">monetization_on</span>
        </div>
        <div class="absolute bottom-1/3 right-20 transform rotate-12">
            <span class="material-symbols-outlined text-tertiary-fixed-dim text-7xl" style="font-variation-settings: 'FILL' 1;">swords</span>
        </div>
        <div class="absolute top-20 right-1/4">
            <span class="material-symbols-outlined text-secondary-container text-5xl" style="font-variation-settings: 'FILL' 1;">star</span>
        </div>
        <div class="absolute bottom-1/4 left-1/4">
            <span class="material-symbols-outlined text-primary-fixed text-4xl" style="font-variation-settings: 'FILL' 1;">shield</span>
        </div>
    </div>

    {{-- Title Display --}}
    <div class="z-10 text-center space-y-8 max-w-4xl">
        <div class="relative inline-block">
            <h1 class="font-headline text-4xl md:text-7xl text-primary-container pixel-glow mb-2 uppercase tracking-tighter">
                QuestLearn
            </h1>
            <div class="absolute -top-6 -right-6 md:-top-10 md:-right-10">
                <span class="material-symbols-outlined text-secondary-container text-3xl md:text-5xl" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
            </div>
        </div>
        <p class="font-body text-2xl md:text-4xl text-on-background tracking-wide">
            Level Up Your Knowledge. Track Your Guild.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 pt-10">
            <x-pixel-button variant="gold" size="lg" href="{{ route('login') }}">
                [ START GAME ]
            </x-pixel-button>
            <a href="{{ route('register') }}"
               class="font-label text-sm md:text-base bg-surface-container-high text-secondary-container px-10 py-6 border-4 border-secondary-container shadow-[4px_4px_0px_0px_#000000] hover:bg-surface-variant active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase text-center inline-block">
                [ REGISTER ]
            </a>
        </div>
    </div>

    {{-- Decorative RPG Footer Silhouette --}}
    <div class="absolute bottom-0 left-0 w-full h-48 z-0 flex items-end overflow-hidden opacity-40 pointer-events-none">
        <div class="w-full flex items-end justify-between px-0">
            <div class="w-1/4 h-32 bg-black clip-path-castle flex items-end">
                <div class="w-12 h-24 bg-black ml-10"></div>
                <div class="w-20 h-40 bg-black"></div>
                <div class="w-12 h-24 bg-black"></div>
            </div>
            <div class="w-2/4 h-48 flex items-end justify-center space-x-0">
                <div class="border-l-[100px] border-l-transparent border-r-[100px] border-r-transparent border-b-[150px] border-b-black"></div>
                <div class="border-l-[150px] border-l-transparent border-r-[150px] border-r-transparent border-b-[220px] border-b-black -mx-20"></div>
                <div class="border-l-[100px] border-l-transparent border-r-[100px] border-r-transparent border-b-[120px] border-b-black"></div>
            </div>
            <div class="w-1/4 h-32 bg-black"></div>
        </div>
    </div>
</main>

{{-- Footer --}}
<footer class="bg-background text-secondary-container font-body text-lg fixed bottom-0 w-full border-t-4 border-black flex flex-col md:flex-row justify-between items-center px-8 py-6 z-40">
    <div class="text-primary-container font-headline text-xs mb-4 md:mb-0">
        QUESTLEARN // V 1.0.4
    </div>
    <div class="flex gap-8 items-center">
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">TERMS</a>
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">PRIVACY</a>
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">SUPPORT</a>
    </div>
    <div class="mt-4 md:mt-0 text-on-surface-variant text-sm">
        &copy; {{ date('Y') }} QUESTLEARN — LEVEL UP YOUR MIND
    </div>
</footer>

{{-- Pixel Star Decorations --}}
<div class="fixed inset-0 pointer-events-none z-10">
    <div class="absolute top-40 right-20 w-2 h-2 bg-white animate-pulse"></div>
    <div class="absolute top-60 left-1/4 w-1 h-1 bg-white opacity-50"></div>
    <div class="absolute bottom-60 right-1/3 w-2 h-2 bg-secondary-container"></div>
    <div class="absolute top-20 left-10 w-2 h-2 bg-primary-container"></div>
</div>

{{-- HUD Overlay Info --}}
<div class="fixed top-24 left-6 z-20 hidden lg:block">
    <x-pixel-card variant="high" padding="sm">
        <p class="font-label text-[0.6rem] text-secondary-container mb-2">SYSTEM STATUS</p>
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-secondary-container"></div>
                <span class="text-xs uppercase">Server: Online</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-primary-container"></div>
                <span class="text-xs uppercase">Users: 1,240</span>
            </div>
        </div>
    </x-pixel-card>
</div>

<style>
    .clip-path-castle {
        clip-path: polygon(0% 100%, 0% 40%, 10% 40%, 10% 20%, 20% 20%, 20% 0%, 30% 0%, 30% 20%, 40% 20%, 40% 40%, 60% 40%, 60% 20%, 70% 20%, 70% 0%, 80% 0%, 80% 20%, 90% 20%, 90% 40%, 100% 40%, 100% 100%);
    }
</style>
@endsection
