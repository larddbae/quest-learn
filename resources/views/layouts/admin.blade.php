@extends('layouts.base')

@section('content')
{{-- ============================================
     FIXED LEFT SIDEBAR — GM COMMAND CENTER
     ============================================ --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-surface-container-low border-r-4 border-black flex-col shadow-[4px_0px_0px_0px_rgba(0,0,0,1)] z-50 hidden md:flex" id="admin-sidebar">
    {{-- Brand Header --}}
    <div class="p-6">
        <a href="{{ route('admin.dashboard') }}" class="block">
            <div class="text-primary-container font-headline text-xl mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">castle</span>
                GM COMMAND
            </div>
        </a>
        {{-- Admin Level Badge --}}
        <div class="mb-8 p-2 bg-background border-2 border-black">
            <p class="font-headline text-[0.6rem] text-tertiary-fixed">LVL 99 ADMIN</p>
            <p class="font-headline text-[0.5rem] text-primary-container mt-1">STATUS: ONLINE</p>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 px-2 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.dashboard')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </a>
        <a href="{{ route('admin.classrooms.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.classrooms.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">monitor_heart</span>
            Guilds
        </a>
        <a href="{{ route('admin.subjects.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.subjects.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">menu_book</span>
            Subjects
        </a>
        <a href="{{ route('admin.quests.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.quests.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">swords</span>
            Quest Board
        </a>
        <a href="{{ route('admin.materials.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.materials.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">auto_stories</span>
            Lore Library
        </a>
        <a href="{{ route('admin.quizzes.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.quizzes.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">pest_control</span>
            Enemy Bestiary
        </a>
        <a href="{{ route('admin.badges.index') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.badges.*')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">military_tech</span>
            Badge Forge
        </a>
        <a href="{{ route('admin.profile') }}"
           class="flex items-center gap-3 px-4 py-3 font-headline text-[0.7rem] uppercase tracking-wider transition-all duration-75
                  {{ request()->routeIs('admin.profile')
                      ? 'bg-surface-container-high text-primary-container border-l-4 border-primary-container translate-x-1'
                      : 'text-[#3a86ff] hover:text-white hover:bg-surface-container-high hover:translate-x-1' }}">
            <span class="material-symbols-outlined">badge</span>
            Edit Identity
        </a>
    </nav>

    {{-- Bottom Section: Settings + Logout --}}
    <div class="p-4 mt-auto space-y-2">
        {{-- GM Info --}}
        <div class="p-2 bg-background border-2 border-black mb-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary-fixed">account_circle</span>
                <div>
                    <p class="font-headline text-[8px] text-on-surface truncate max-w-[140px]">{{ auth()->user()->name }}</p>
                    <p class="font-headline text-[7px] text-primary-container">GAME MASTER</p>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:text-white font-headline text-[0.6rem] w-full transition-colors">
                <span class="material-symbols-outlined text-sm">logout</span>
                Log Out
            </button>
        </form>
    </div>
</aside>

{{-- ============================================
     TOP APP BAR
     ============================================ --}}
<header class="w-full h-16 border-b-4 border-black sticky top-0 z-40 bg-background/80 backdrop-blur-sm flex items-center justify-between px-8 shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] md:pl-72">
    {{-- Mobile menu toggle --}}
    <button class="md:hidden text-primary-container p-2 hover:bg-surface-container transition-colors"
            onclick="document.getElementById('admin-sidebar').classList.toggle('admin-sidebar-open')">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <h1 class="font-headline text-primary-container uppercase text-sm hidden sm:block">GM HUD v1.0</h1>

    <div class="flex items-center gap-4 md:gap-8">
        {{-- Notification & Shield Icons --}}
        <div class="flex items-center gap-4 text-primary-container">
            <span class="material-symbols-outlined hover:text-secondary-container cursor-pointer">notifications</span>
            <span class="material-symbols-outlined hover:text-secondary-container cursor-pointer hidden sm:inline">shield</span>
        </div>
        {{-- Admin Name --}}
        <div class="flex items-center gap-2 border-l-2 border-black pl-4">
            <span class="material-symbols-outlined text-tertiary-fixed">account_circle</span>
            <span class="font-body text-xl text-on-surface hidden sm:inline">{{ auth()->user()->name }}</span>
        </div>
    </div>
</header>

{{-- ============================================
     MAIN CONTENT AREA
     ============================================ --}}
<main class="md:ml-64 min-h-screen pb-16">
    <div class="p-6 md:p-8 space-y-6">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="pixel-alert pixel-alert-success flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="pixel-alert pixel-alert-error flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div class="pixel-alert pixel-alert-info flex items-center gap-3">
                <span class="material-symbols-outlined">info</span>
                {{ session('info') }}
            </div>
        @endif

        @yield('main')
    </div>
</main>

{{-- ============================================
     BOTTOM COMMAND BAR
     ============================================ --}}
<footer class="fixed bottom-0 md:left-64 right-0 left-0 h-12 bg-surface-container-lowest border-t-4 border-black flex items-center px-6 md:px-8 z-30">
    <div class="flex items-center gap-4 md:gap-6">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-secondary-container rounded-full animate-pulse"></span>
            <span class="font-body text-lg text-secondary-container uppercase tracking-widest hidden sm:inline">System Operational</span>
        </div>
        <div class="h-4 w-px bg-surface-container-highest hidden sm:block"></div>
        <p class="font-body text-tertiary-fixed-dim uppercase text-sm hidden md:block">CPU: 24% | MEM: 412MB</p>
    </div>
    <div class="ml-auto flex gap-4">
        <form method="POST" action="{{ route('logout') }}" class="md:hidden">
            @csrf
            <button type="submit" class="font-headline text-[0.55rem] text-error hover:text-white uppercase transition-colors">
                [ LOGOUT ]
            </button>
        </form>
    </div>
</footer>

{{-- ============================================
     MOBILE SIDEBAR STYLES
     ============================================ --}}
<style>
    /* Mobile sidebar toggle */
    @media (max-width: 767px) {
        #admin-sidebar.admin-sidebar-open {
            display: flex !important;
            position: fixed;
            inset: 0;
            width: 100%;
            max-width: 280px;
            z-index: 60;
        }
    }
</style>
@endsection
