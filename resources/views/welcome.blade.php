@extends('layouts.guest')

@section('title', 'QuestLearn — Level Up Your Mind')

@section('guest-content')


{{-- ============================================================
     SECTION 1: HERO — Arcade Start Screen (100vh)
     ============================================================ --}}
<main id="hero" class="flex-grow flex flex-col items-center justify-center relative overflow-hidden px-4 pt-24 pb-32 min-h-screen">
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

    {{-- Bouncing Scroll Down Indicator --}}
    <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-20 animate-bounce-down">
        <a href="#lore" class="flex flex-col items-center gap-2 text-on-surface-variant hover:text-primary-container transition-colors">
            <span class="font-label text-[0.5rem] uppercase tracking-widest">Scroll Down</span>
            <span class="material-symbols-outlined text-3xl">keyboard_double_arrow_down</span>
        </a>
    </div>
</main>


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


{{-- ============================================================
     SECTION 2: THE LORE — About / Mission
     ============================================================ --}}
<section id="lore" class="relative py-24 md:py-32 px-6 overflow-hidden">
    {{-- Section divider top --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary-container to-transparent"></div>

    <div class="max-w-4xl mx-auto scroll-reveal">
        {{-- Section Header --}}
        <div class="text-center mb-12">
            <p class="font-label text-[0.6rem] text-secondary-container tracking-widest mb-4">// CHAPTER 01</p>
            <h2 class="font-headline text-2xl md:text-4xl text-primary-container pixel-glow uppercase tracking-tight">
                The Lore
            </h2>
        </div>

        {{-- Pixel Art Text Box --}}
        <div class="relative border-4 border-primary-container bg-surface-container-low shadow-[6px_6px_0px_0px_#000000] p-8 md:p-12">
            {{-- Corner decorations --}}
            <div class="absolute -top-2 -left-2 w-4 h-4 bg-primary-container"></div>
            <div class="absolute -top-2 -right-2 w-4 h-4 bg-primary-container"></div>
            <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-primary-container"></div>
            <div class="absolute -bottom-2 -right-2 w-4 h-4 bg-primary-container"></div>

            {{-- Dialogue icon --}}
            <div class="flex items-start gap-6">
                <div class="hidden md:flex flex-col items-center gap-2 shrink-0">
                    <div class="w-16 h-16 border-4 border-black bg-surface-container-high flex items-center justify-center shadow-[3px_3px_0px_0px_#000000]">
                        <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                    </div>
                    <span class="font-label text-[0.45rem] text-primary-container">NPC</span>
                </div>

                <div class="space-y-4">
                    <p class="font-body text-xl md:text-2xl text-on-surface leading-relaxed">
                        "Brave adventurer, welcome to <span class="text-primary-container font-bold">QuestLearn</span> — a realm where
                        boring lectures are reforged into <span class="text-secondary-container font-bold">epic quests</span>,
                        dusty classrooms become <span class="text-tertiary-fixed-dim font-bold">powerful guilds</span>,
                        and every lesson conquered earns you <span class="text-primary-container font-bold">XP & glory</span>."
                    </p>
                    <p class="font-body text-lg md:text-xl text-on-surface-variant leading-relaxed">
                        Our mission: Transform the mundane world of e-learning into an RPG adventure where knowledge is power,
                        progress is visible, and every student becomes the hero of their own story.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <div class="w-3 h-3 bg-secondary-container animate-pulse"></div>
                        <span class="font-label text-[0.5rem] text-secondary-container tracking-wider">PRESS START TO BEGIN YOUR JOURNEY...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: GAME MECHANICS — Features Bento Grid
     ============================================================ --}}
<section id="mechanics" class="relative py-24 md:py-32 px-6 overflow-hidden">
    {{-- Section divider top --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-secondary-container to-transparent"></div>

    <div class="max-w-6xl mx-auto">
        {{-- Section Header --}}
        <div class="text-center mb-16 scroll-reveal">
            <p class="font-label text-[0.6rem] text-secondary-container tracking-widest mb-4">// CHAPTER 02</p>
            <h2 class="font-headline text-2xl md:text-4xl text-secondary-container pixel-glow-green uppercase tracking-tight">
                Game Mechanics
            </h2>
            <p class="font-body text-lg text-on-surface-variant mt-4 max-w-2xl mx-auto">
                Master the core systems that power your adventure.
            </p>
        </div>

        {{-- Bento Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 border-4 border-black shadow-[8px_8px_0px_0px_#000000]">

            {{-- Card 1: Quests --}}
            <div class="scroll-reveal stagger-1 border-b-4 md:border-r-4 border-black bg-surface-container-low p-8 group hover:bg-surface-container transition-colors duration-200 lg:col-span-2 lg:row-span-2">
                <div class="flex flex-col h-full">
                    <div class="w-14 h-14 border-4 border-black bg-primary-container flex items-center justify-center shadow-[3px_3px_0px_0px_#000000] mb-6 group-hover:translate-x-[-2px] group-hover:translate-y-[-2px] group-hover:shadow-[5px_5px_0px_0px_#000000] transition-all">
                        <span class="material-symbols-outlined text-black text-2xl" style="font-variation-settings: 'FILL' 1;">swords</span>
                    </div>
                    <h3 class="font-headline text-base md:text-lg text-primary-container mb-3 uppercase">⚔ Quests</h3>
                    <p class="font-label text-[0.55rem] text-secondary-container mb-3 tracking-wider">A.K.A. ASSIGNMENTS</p>
                    <p class="font-body text-lg text-on-surface-variant leading-relaxed flex-grow">
                        Every assignment is a quest waiting to be conquered. Complete challenges, submit your work,
                        and earn XP to level up. Track your progress through the quest log and become a legendary scholar.
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="h-2 flex-grow bg-surface-container-lowest border-2 border-black">
                            <div class="h-full w-3/4 bg-primary-container"></div>
                        </div>
                        <span class="font-label text-[0.45rem] text-primary-container">75% XP</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Guilds --}}
            <div class="scroll-reveal stagger-2 border-b-4 lg:border-r-4 border-black bg-surface-container-low p-8 group hover:bg-surface-container transition-colors duration-200 lg:col-span-2">
                <div class="w-14 h-14 border-4 border-black bg-secondary-container flex items-center justify-center shadow-[3px_3px_0px_0px_#000000] mb-6 group-hover:translate-x-[-2px] group-hover:translate-y-[-2px] group-hover:shadow-[5px_5px_0px_0px_#000000] transition-all">
                    <span class="material-symbols-outlined text-black text-2xl" style="font-variation-settings: 'FILL' 1;">groups</span>
                </div>
                <h3 class="font-headline text-base md:text-lg text-secondary-container mb-3 uppercase">🏰 Guilds</h3>
                <p class="font-label text-[0.55rem] text-primary-container mb-3 tracking-wider">A.K.A. CLASSROOMS</p>
                <p class="font-body text-lg text-on-surface-variant leading-relaxed">
                    Join a Guild to band with fellow adventurers. Your classroom is your guild hall — share knowledge,
                    compete on leaderboards, and rise through the ranks together.
                </p>
            </div>

            {{-- Card 3: Badges --}}
            <div class="scroll-reveal stagger-3 border-b-4 md:border-b-0 md:border-r-4 lg:border-r-4 border-black bg-surface-container-low p-8 group hover:bg-surface-container transition-colors duration-200">
                <div class="w-14 h-14 border-4 border-black bg-pixel-blue flex items-center justify-center shadow-[3px_3px_0px_0px_#000000] mb-6 group-hover:translate-x-[-2px] group-hover:translate-y-[-2px] group-hover:shadow-[5px_5px_0px_0px_#000000] transition-all">
                    <span class="material-symbols-outlined text-white text-2xl" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                </div>
                <h3 class="font-headline text-base md:text-lg text-tertiary-fixed-dim mb-3 uppercase">🏅 Badges</h3>
                <p class="font-label text-[0.55rem] text-secondary-container mb-3 tracking-wider">A.K.A. ACHIEVEMENTS</p>
                <p class="font-body text-lg text-on-surface-variant leading-relaxed">
                    Unlock badges for your heroic deeds. Perfect scores, streaks, and milestones all award unique pixel-art badges.
                </p>
            </div>

            {{-- Card 4: Lore Library --}}
            <div class="scroll-reveal stagger-4 bg-surface-container-low p-8 group hover:bg-surface-container transition-colors duration-200">
                <div class="w-14 h-14 border-4 border-black bg-pixel-purple flex items-center justify-center shadow-[3px_3px_0px_0px_#000000] mb-6 group-hover:translate-x-[-2px] group-hover:translate-y-[-2px] group-hover:shadow-[5px_5px_0px_0px_#000000] transition-all">
                    <span class="material-symbols-outlined text-black text-2xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                </div>
                <h3 class="font-headline text-base md:text-lg text-pixel-purple mb-3 uppercase">📜 Lore Library</h3>
                <p class="font-label text-[0.55rem] text-secondary-container mb-3 tracking-wider">A.K.A. MATERIALS</p>
                <p class="font-body text-lg text-on-surface-variant leading-relaxed">
                    All study materials live in the Lore Library — your enchanted archive of PDFs, videos, and ancient scrolls of wisdom.
                </p>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: CHOOSE YOUR CLASS — User Roles
     ============================================================ --}}
<section id="classes" class="relative py-24 md:py-32 px-6 overflow-hidden">
    {{-- Section divider top --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-tertiary-fixed-dim to-transparent"></div>

    <div class="max-w-5xl mx-auto">
        {{-- Section Header --}}
        <div class="text-center mb-16 scroll-reveal">
            <p class="font-label text-[0.6rem] text-secondary-container tracking-widest mb-4">// CHAPTER 03</p>
            <h2 class="font-headline text-2xl md:text-4xl text-tertiary-fixed-dim uppercase tracking-tight">
                Choose Your Class
            </h2>
            <p class="font-body text-lg text-on-surface-variant mt-4 max-w-2xl mx-auto">
                Every hero has a role. Which one will you play?
            </p>
        </div>

        {{-- Role Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- GAME MASTER (Teacher) --}}
            <div class="scroll-reveal stagger-1 group relative border-4 border-primary-container bg-surface-container-low shadow-[6px_6px_0px_0px_#000000] hover:shadow-[8px_8px_0px_0px_#000000] hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all duration-200 overflow-hidden">
                {{-- Header bar --}}
                <div class="bg-primary-container px-6 py-4 border-b-4 border-black flex items-center gap-3">
                    <span class="material-symbols-outlined text-black text-2xl" style="font-variation-settings: 'FILL' 1;">shield_person</span>
                    <h3 class="font-headline text-sm md:text-base text-black uppercase">The Game Master</h3>
                </div>

                <div class="p-8">
                    {{-- Role tag --}}
                    <div class="inline-block border-3 border-black bg-surface-container-high px-4 py-2 mb-6 shadow-[3px_3px_0px_0px_#000000]">
                        <span class="font-label text-[0.55rem] text-primary-container tracking-widest">CLASS: TEACHER</span>
                    </div>

                    {{-- Icon --}}
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 border-4 border-black bg-surface-container-high flex items-center justify-center shadow-[4px_4px_0px_0px_#000000]">
                            <span class="material-symbols-outlined text-primary-container text-5xl" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                        </div>
                    </div>

                    {{-- Abilities list --}}
                    <p class="font-label text-[0.5rem] text-primary-container mb-4 tracking-widest">ABILITIES:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="text-primary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Forge new quests and assign them to guilds</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-primary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Monitor student progress with the Player Dossier</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-primary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Curate the Lore Library with learning materials</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-primary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Manage guilds and broadcast system alerts</span>
                        </li>
                    </ul>

                    {{-- Stats --}}
                    <div class="mt-8 pt-6 border-t-2 border-surface-container-highest grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="font-headline text-xl text-primary-container">∞</p>
                            <p class="font-label text-[0.45rem] text-on-surface-variant">POWER</p>
                        </div>
                        <div class="text-center">
                            <p class="font-headline text-xl text-secondary-container">S+</p>
                            <p class="font-label text-[0.45rem] text-on-surface-variant">RANK</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ADVENTURER (Student) --}}
            <div class="scroll-reveal stagger-2 group relative border-4 border-secondary-container bg-surface-container-low shadow-[6px_6px_0px_0px_#000000] hover:shadow-[8px_8px_0px_0px_#000000] hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all duration-200 overflow-hidden">
                {{-- Header bar --}}
                <div class="bg-secondary-container px-6 py-4 border-b-4 border-black flex items-center gap-3">
                    <span class="material-symbols-outlined text-black text-2xl" style="font-variation-settings: 'FILL' 1;">person</span>
                    <h3 class="font-headline text-sm md:text-base text-black uppercase">The Adventurer</h3>
                </div>

                <div class="p-8">
                    {{-- Role tag --}}
                    <div class="inline-block border-3 border-black bg-surface-container-high px-4 py-2 mb-6 shadow-[3px_3px_0px_0px_#000000]">
                        <span class="font-label text-[0.55rem] text-secondary-container tracking-widest">CLASS: STUDENT</span>
                    </div>

                    {{-- Icon --}}
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 border-4 border-black bg-surface-container-high flex items-center justify-center shadow-[4px_4px_0px_0px_#000000]">
                            <span class="material-symbols-outlined text-secondary-container text-5xl" style="font-variation-settings: 'FILL' 1;">bolt</span>
                        </div>
                    </div>

                    {{-- Abilities list --}}
                    <p class="font-label text-[0.5rem] text-secondary-container mb-4 tracking-widest">ABILITIES:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="text-secondary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Complete quests to earn XP and level up</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-secondary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Join guilds and compete on the leaderboard</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-secondary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Collect badges for achievements and milestones</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-secondary-container font-headline text-xs mt-1">▸</span>
                            <span class="font-body text-lg text-on-surface">Study from the Lore Library and ace quizzes</span>
                        </li>
                    </ul>

                    {{-- Stats --}}
                    <div class="mt-8 pt-6 border-t-2 border-surface-container-highest grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="font-headline text-xl text-secondary-container">0</p>
                            <p class="font-label text-[0.45rem] text-on-surface-variant">START XP</p>
                        </div>
                        <div class="text-center">
                            <p class="font-headline text-xl text-primary-container">E</p>
                            <p class="font-label text-[0.45rem] text-on-surface-variant">START RANK</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Final CTA --}}
        <div class="scroll-reveal text-center mt-16">
            <p class="font-body text-xl text-on-surface-variant mb-8">Ready to embark on your journey?</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <x-pixel-button variant="gold" size="lg" href="{{ route('register') }}">
                    [ CREATE CHARACTER ]
                </x-pixel-button>
                <x-pixel-button variant="green" size="lg" href="{{ route('login') }}">
                    [ CONTINUE SAVE ]
                </x-pixel-button>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SCROLL REVEAL SCRIPT
     ============================================================ --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reveals = document.querySelectorAll('.scroll-reveal');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        reveals.forEach(el => observer.observe(el));
    });
</script>

<style>
    .clip-path-castle {
        clip-path: polygon(0% 100%, 0% 40%, 10% 40%, 10% 20%, 20% 20%, 20% 0%, 30% 0%, 30% 20%, 40% 20%, 40% 40%, 60% 40%, 60% 20%, 70% 20%, 70% 0%, 80% 0%, 80% 20%, 90% 20%, 90% 40%, 100% 40%, 100% 100%);
    }
</style>
@endsection
