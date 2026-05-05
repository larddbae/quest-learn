@extends('layouts.public')

@section('title', 'QuestLearn — Level Up Your Knowledge')

@section('public-content')

{{-- ============================================================
     CUSTOM STYLES FOR LANDING PAGE
     ============================================================ --}}
<style>
    .retro-button {
        border: 4px solid #000000;
        box-shadow: 4px 4px 0px 0px #000000;
        transition: all 0.1s ease;
        border-radius: 0;
    }
    .retro-button:active {
        box-shadow: 0px 0px 0px 0px #000000;
        transform: translate(4px, 4px);
    }
    .retro-card {
        border: 4px solid #000000;
        box-shadow: 6px 6px 0px 0px #000000;
        border-radius: 0;
        background-color: #1c1c3b;
    }
    .retro-container {
        border: 2px solid #4d4732;
        border-radius: 0;
    }
    .pixelated {
        image-rendering: pixelated;
    }
</style>


{{-- ============================================================
     MAIN CONTENT WRAPPER
     ============================================================ --}}
<main class="max-w-7xl mx-auto px-6 pt-24">

    {{-- ============================================================
         SECTION 1: QUESTS
         ============================================================ --}}
    <section id="quests" class="min-h-[819px] flex flex-col lg:flex-row items-center justify-between py-16 gap-12">
        <div class="w-full lg:w-1/2 space-y-8 z-10">
            <div class="inline-block px-4 py-2 bg-surface-container-high border-2 border-outline-variant">
                <span class="font-label text-xs tracking-wider text-secondary-container uppercase">System initialized</span>
            </div>
            <h1 class="font-display text-4xl lg:text-5xl xl:text-6xl text-primary-container leading-tight uppercase tracking-widest drop-shadow-[4px_4px_0_rgba(0,0,0,1)]">
                LEVEL UP YOUR<br/>KNOWLEDGE
            </h1>
            <p class="font-body text-xl md:text-2xl text-on-surface-variant max-w-xl">
                Embark on an epic journey where learning meets legacy. Complete quests, master skills, and forge your path in the ultimate educational RPG.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 pt-4">
                <a href="{{ route('register') }}" class="retro-button bg-primary-container text-black font-label text-sm py-4 px-8 uppercase tracking-widest hover:bg-primary-fixed text-center">
                    [ START YOUR QUEST ]
                </a>
                <a href="#lore" class="retro-button bg-surface-container-high text-on-surface font-label text-sm py-4 px-8 uppercase tracking-widest border-outline-variant hover:bg-surface-container-highest text-center">
                    LEARN MORE
                </a>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex justify-center items-center relative">
            {{-- Radial Glow Simulation --}}
            <div class="absolute w-96 h-96 bg-primary-container/20 blur-[100px] rounded-full z-0 pointer-events-none"></div>
            {{--
                TODO: Download the hero knight image and place it at:
                public/images/landing/hero-knight.png
            --}}
            <img
                alt="Hero Sprite - A futuristic knight with glowing energy sword"
                class="relative z-10 w-full max-w-md h-auto retro-card p-2 pixelated"
                src="{{ asset('images/landing/hero-knight.png') }}"
            />
        </div>
    </section>

    {{-- ============================================================
         SECTION 2: THE LORE
         ============================================================ --}}
    <section id="lore" class="py-24 space-y-16 scroll-reveal">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <div class="w-full lg:w-5/12 space-y-6">
                <h2 class="font-headline text-2xl text-primary-container uppercase tracking-wider drop-shadow-[2px_2px_0_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined align-middle mr-2 text-secondary-container" style="font-variation-settings: 'FILL' 1;">book</span>
                    The Lore
                </h2>
                <div class="retro-container p-6 bg-surface-container-low">
                    <p class="font-body text-lg text-on-surface leading-relaxed mb-4">
                        In the forgotten realms of standardized testing, true understanding was lost. The ancient scrolls of pedagogy were corrupted by mindless repetition.
                    </p>
                    <p class="font-body text-lg text-on-surface leading-relaxed">
                        Now, a new guild rises. We reject the mundane. We gamify the grind. Every concept mastered is a monster defeated. Every exam passed is a dungeon conquered.
                    </p>
                </div>
            </div>
            <div class="w-full lg:w-7/12 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="retro-card p-4 relative group">
                    <div class="absolute -top-3 -left-3 bg-error text-on-error font-label text-[0.6rem] px-2 py-1 border-2 border-black uppercase z-10">Before</div>
                    {{--
                        TODO: Download the "boring classroom" image and place it at:
                        public/images/landing/lore-before.png
                    --}}
                    <img
                        alt="Boring Classroom - A gloomy, dull classroom scene"
                        class="w-full h-48 object-cover pixelated border-2 border-black grayscale opacity-70 group-hover:grayscale-0 transition-all"
                        src="{{ asset('images/landing/lore-before.png') }}"
                    />
                </div>
                <div class="retro-card p-4 relative group">
                    <div class="absolute -top-3 -right-3 bg-secondary-container text-black font-label text-[0.6rem] px-2 py-1 border-2 border-black uppercase z-10">After</div>
                    {{--
                        TODO: Download the "exciting quest hub" image and place it at:
                        public/images/landing/lore-after.png
                    --}}
                    <img
                        alt="Exciting Quest Hub - A vibrant, dynamic learning environment"
                        class="w-full h-48 object-cover pixelated border-2 border-black group-hover:brightness-110 transition-all"
                        src="{{ asset('images/landing/lore-after.png') }}"
                    />
                </div>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 scroll-reveal">
            <div class="retro-card bg-surface-container flex items-center p-6 gap-6 hover:-translate-y-2 transition-transform">
                <div class="bg-surface-container-high p-4 border-2 border-black">
                    <span class="material-symbols-outlined text-4xl text-primary-container" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                </div>
                <div>
                    <div class="font-display text-2xl text-primary-container mb-1">10,000+</div>
                    <div class="font-body text-lg text-on-surface-variant uppercase">Quests Completed</div>
                </div>
            </div>
            <div class="retro-card bg-surface-container flex items-center p-6 gap-6 hover:-translate-y-2 transition-transform">
                <div class="bg-surface-container-high p-4 border-2 border-black">
                    <span class="material-symbols-outlined text-4xl text-secondary-container" style="font-variation-settings: 'FILL' 1;">shield</span>
                </div>
                <div>
                    <div class="font-display text-2xl text-secondary-container mb-1">500+</div>
                    <div class="font-body text-lg text-on-surface-variant uppercase">Active Guilds</div>
                </div>
            </div>
            <div class="retro-card bg-surface-container flex items-center p-6 gap-6 hover:-translate-y-2 transition-transform">
                <div class="bg-surface-container-high p-4 border-2 border-black">
                    <span class="material-symbols-outlined text-4xl text-tertiary-fixed-dim" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
                <div>
                    <div class="font-display text-2xl text-tertiary-fixed-dim mb-1">99</div>
                    <div class="font-body text-lg text-on-surface-variant uppercase">Max Level Reached</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION 3: SYSTEM MECHANICS (Bento Grid)
         ============================================================ --}}
    <section id="equipment" class="py-24 border-t-2 border-outline-variant border-dashed">
        <h2 class="font-headline text-3xl text-center text-primary-container uppercase tracking-wider mb-16 drop-shadow-[4px_4px_0_rgba(0,0,0,1)] scroll-reveal">
            System Mechanics
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            {{-- Bento Card 1: Quests --}}
            <div class="retro-card bg-surface-container-low/80 p-6 flex flex-col items-start gap-4 hover:bg-surface-container transition-colors lg:col-span-2 scroll-reveal stagger-1">
                <div class="bg-surface-container-high p-3 border-2 border-black inline-block">
                    <span class="material-symbols-outlined text-3xl text-primary-container" style="font-variation-settings: 'FILL' 1;">explore</span>
                </div>
                <h3 class="font-headline text-xl text-on-surface uppercase">Quests</h3>
                <p class="font-body text-on-surface-variant text-lg">Interactive modules disguised as daring missions. Defeat bosses (exams) through knowledge.</p>
            </div>
            {{-- Bento Card 2: Guilds --}}
            <div class="retro-card bg-surface-container-low/80 p-6 flex flex-col items-start gap-4 hover:bg-surface-container transition-colors scroll-reveal stagger-2">
                <div class="bg-surface-container-high p-3 border-2 border-black inline-block">
                    <span class="material-symbols-outlined text-3xl text-secondary-container" style="font-variation-settings: 'FILL' 1;">diversity_3</span>
                </div>
                <h3 class="font-headline text-xl text-on-surface uppercase">Guilds</h3>
                <p class="font-body text-on-surface-variant text-lg">Form alliances. Study together. Share loot (notes).</p>
            </div>
            {{-- Bento Card 3: Lore Library --}}
            <div class="retro-card bg-surface-container-low/80 p-6 flex flex-col items-start gap-4 hover:bg-surface-container transition-colors scroll-reveal stagger-3">
                <div class="bg-surface-container-high p-3 border-2 border-black inline-block">
                    <span class="material-symbols-outlined text-3xl text-tertiary-fixed-dim" style="font-variation-settings: 'FILL' 1;">local_library</span>
                </div>
                <h3 class="font-headline text-xl text-on-surface uppercase">Lore Library</h3>
                <p class="font-body text-on-surface-variant text-lg">Vast archives of video scrolls and text artifacts.</p>
            </div>
            {{-- Bento Card 4: Badges (full-width) --}}
            <div class="retro-card bg-surface-container-low/80 p-6 flex flex-col items-start gap-4 hover:bg-surface-container transition-colors lg:col-span-4 scroll-reveal stagger-4">
                <div class="flex items-center gap-4 w-full border-b-2 border-outline-variant pb-4 mb-2">
                    <div class="bg-surface-container-high p-3 border-2 border-black inline-block">
                        <span class="material-symbols-outlined text-3xl text-primary-fixed" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                    </div>
                    <h3 class="font-headline text-xl text-on-surface uppercase">Badges</h3>
                </div>
                <div class="flex flex-wrap gap-4 w-full justify-around py-4">
                    <span class="material-symbols-outlined text-5xl text-secondary-container opacity-80 hover:opacity-100 hover:scale-110 transition-all" style="font-variation-settings: 'FILL' 1;">diamond</span>
                    <span class="material-symbols-outlined text-5xl text-primary-container opacity-80 hover:opacity-100 hover:scale-110 transition-all" style="font-variation-settings: 'FILL' 1;">key</span>
                    <span class="material-symbols-outlined text-5xl text-error opacity-80 hover:opacity-100 hover:scale-110 transition-all" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                    <span class="material-symbols-outlined text-5xl text-tertiary-fixed opacity-80 hover:opacity-100 hover:scale-110 transition-all" style="font-variation-settings: 'FILL' 1;">water_drop</span>
                </div>
            </div>
        </div>

        {{-- Progression Flow Diagram --}}
        <div class="retro-container bg-surface-container-lowest p-8 overflow-x-auto scroll-reveal">
            <div class="flex items-center justify-between min-w-[800px] gap-4 font-label text-xs tracking-widest uppercase">
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-on-surface-variant">menu_book</span>
                    <span class="text-on-surface">Read</span>
                </div>
                <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-on-surface-variant">quiz</span>
                    <span class="text-on-surface">Quiz</span>
                </div>
                <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-secondary-container" style="font-variation-settings: 'FILL' 1;">bolt</span>
                    <span class="text-secondary-container">XP</span>
                </div>
                <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-primary-container" style="font-variation-settings: 'FILL' 1;">upgrade</span>
                    <span class="text-primary-container">Level Up</span>
                </div>
                <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-primary-fixed" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <span class="text-on-surface">Badge</span>
                </div>
                <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-2xl text-error" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <span class="text-on-surface">Rank</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION 4: CHOOSE YOUR CLASS
         ============================================================ --}}
    <section id="guilds" class="py-24">
        <h2 class="font-headline text-3xl text-center text-primary-container uppercase tracking-wider mb-20 drop-shadow-[4px_4px_0_rgba(0,0,0,1)] scroll-reveal">
            Choose Your Class
        </h2>
        <div class="relative flex flex-col lg:flex-row gap-12 items-stretch justify-center">

            {{-- Adventurer Card (Student) --}}
            <div class="retro-card bg-surface-container w-full lg:w-5/12 border-secondary-container group hover:-translate-y-2 transition-transform relative overflow-hidden scroll-reveal stagger-1">
                <div class="absolute top-0 right-0 bg-secondary-container text-black font-label text-[0.6rem] px-3 py-2 border-b-4 border-l-4 border-black uppercase">Student</div>
                <div class="p-8 flex flex-col items-center text-center">
                    <div class="w-48 h-48 mb-6 border-4 border-black bg-surface-container-highest relative">
                        {{--
                            TODO: Download the adventurer sprite image and place it at:
                            public/images/landing/adventurer.png
                        --}}
                        <img
                            alt="The Adventurer Sprite"
                            class="w-full h-full object-cover pixelated"
                            src="{{ asset('images/landing/adventurer.png') }}"
                        />
                    </div>
                    <h3 class="font-headline text-2xl text-secondary-container uppercase mb-2">The Adventurer</h3>
                    <p class="font-body text-on-surface-variant mb-8 h-16">Seek out knowledge, conquer exams, and build your ultimate skill tree.</p>
                    <div class="w-full text-left bg-surface-container-low border-2 border-outline p-4 font-body text-lg text-on-surface space-y-3">
                        <div class="flex items-center gap-2 border-b-2 border-outline-variant pb-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            Access to all active quests
                        </div>
                        <div class="flex items-center gap-2 border-b-2 border-outline-variant pb-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            Join and create Guilds
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            Earn XP and climb the Leaderboard
                        </div>
                    </div>
                    <a href="{{ route('register') }}" class="retro-button w-full mt-8 bg-secondary-container text-black font-label text-sm py-4 px-4 uppercase tracking-widest hover:bg-secondary text-center block">
                        SELECT CLASS
                    </a>
                </div>
            </div>

            {{-- VS Badge --}}
            <div class="hidden lg:flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 items-center justify-center">
                <div class="bg-error border-4 border-black p-4 shadow-[4px_4px_0_rgba(0,0,0,1)] rounded-full w-20 h-20 flex items-center justify-center rotate-12">
                    <span class="font-headline text-xl text-on-error uppercase drop-shadow-[2px_2px_0_rgba(255,255,255,0.5)]">VS</span>
                </div>
            </div>

            {{-- Game Master Card (Educator) --}}
            <div class="retro-card bg-surface-container w-full lg:w-5/12 border-primary-container group hover:-translate-y-2 transition-transform relative overflow-hidden scroll-reveal stagger-2">
                <div class="absolute top-0 left-0 bg-primary-container text-black font-label text-[0.6rem] px-3 py-2 border-b-4 border-r-4 border-black uppercase z-10">Educator</div>
                <div class="p-8 flex flex-col items-center text-center relative">
                    <div class="w-48 h-48 mb-6 border-4 border-black bg-surface-container-highest relative">
                        {{--
                            TODO: Download the game master sprite image and place it at:
                            public/images/landing/game-master.png
                        --}}
                        <img
                            alt="The Game Master Sprite"
                            class="w-full h-full object-cover pixelated"
                            src="{{ asset('images/landing/game-master.png') }}"
                        />
                    </div>
                    <h3 class="font-headline text-2xl text-primary-container uppercase mb-2">The Game Master</h3>
                    <p class="font-body text-on-surface-variant mb-8 h-16">Design epic campaigns, forge new quests, and guide adventurers to victory.</p>
                    <div class="w-full text-left bg-surface-container-low border-2 border-outline p-4 font-body text-lg text-on-surface space-y-3">
                        <div class="flex items-center gap-2 border-b-2 border-outline-variant pb-2">
                            <span class="material-symbols-outlined text-primary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            World Builder tool access
                        </div>
                        <div class="flex items-center gap-2 border-b-2 border-outline-variant pb-2">
                            <span class="material-symbols-outlined text-primary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            Custom Badge generation
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-sm" style="font-variation-settings: 'FILL' 1;">check_box</span>
                            Advanced Analytics (Scrying)
                        </div>
                    </div>
                    <a href="{{ route('register') }}" class="retro-button w-full mt-8 bg-primary-container text-black font-label text-sm py-4 px-4 uppercase tracking-widest hover:bg-primary-fixed text-center block">
                        SELECT CLASS
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>


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

@endsection
