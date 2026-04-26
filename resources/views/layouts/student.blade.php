@extends('layouts.base')

@section('content')
{{-- ============================================
     TOP NAVIGATION BAR
     ============================================ --}}
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 h-20 bg-background border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]" id="student-topnav">
    {{-- Brand --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('student.dashboard') }}" class="text-2xl font-black text-primary-container drop-shadow-[4px_4px_0px_rgba(0,0,0,1)] font-headline uppercase tracking-wider">
            QUESTLEARN
        </a>
    </div>

    {{-- Desktop Nav Links --}}
    <div class="hidden md:flex items-center gap-4 lg:gap-6 font-headline uppercase tracking-wider text-[10px] lg:text-xs">
        <a href="{{ route('student.dashboard') }}"
           class="pixel-nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            HOME
        </a>
        <a href="{{ route('student.guild-select') }}"
           class="pixel-nav-link {{ request()->routeIs('student.guild-select') ? 'active' : '' }}">
            GUILDS
        </a>
        <a href="{{ route('student.subjects.index') }}"
           class="pixel-nav-link {{ request()->routeIs('student.subjects.*') ? 'active' : '' }}">
            SUBJECTS
        </a>
        <a href="{{ route('student.quest-board') }}"
           class="pixel-nav-link {{ request()->routeIs('student.quest-board') || request()->routeIs('student.quests.*') ? 'active' : '' }}">
            QUESTS
        </a>
        <a href="{{ route('student.learning-room') }}"
           class="pixel-nav-link {{ request()->routeIs('student.learning-room') || request()->routeIs('student.materials.*') ? 'active' : '' }}">
            LORE
        </a>
        <a href="{{ route('student.leaderboard') }}"
           class="pixel-nav-link {{ request()->routeIs('student.leaderboard') ? 'active' : '' }}">
            LEADERBOARD
        </a>
        <a href="{{ route('student.profile') }}"
           class="pixel-nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
            PROFILE
        </a>
    </div>

    {{-- Right Actions: notifications, settings, avatar --}}
    <div class="flex items-center gap-4">
        <button class="text-primary-container p-2 hover:bg-surface-container transition-colors" title="Notifications">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="text-primary-container p-2 hover:bg-surface-container transition-colors md:hidden"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                title="Menu">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="w-10 h-10 border-2 border-black bg-surface-container-high flex items-center justify-center overflow-hidden" title="{{ auth()->user()->name }}">
            <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">person</span>
        </div>
    </div>
</nav>

{{-- ============================================
     MOBILE MENU (hidden by default)
     ============================================ --}}
<div id="mobile-menu" class="hidden fixed top-20 left-0 w-full bg-surface-container-low border-b-4 border-black z-40 md:hidden">
    <nav class="flex flex-col py-2">
        <a href="{{ route('student.dashboard') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">home</span> Dashboard
        </a>
        <a href="{{ route('student.guild-select') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.guild-select') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">fort</span> Guild Hall
        </a>
        <a href="{{ route('student.subjects.index') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.subjects.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">menu_book</span> Subject Hub
        </a>
        <a href="{{ route('student.quest-board') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.quest-board') || request()->routeIs('student.quests.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">explore</span> Quest Board
        </a>
        <a href="{{ route('student.learning-room') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.learning-room') || request()->routeIs('student.materials.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">auto_stories</span> Learning Room
        </a>
        <a href="{{ route('student.profile') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">person</span> Profile
        </a>
        <a href="{{ route('student.leaderboard') }}"
           class="pixel-sidebar-link {{ request()->routeIs('student.leaderboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined text-lg">trophy</span> Leaderboard
        </a>

        {{-- Player Mini Status (mobile) --}}
        <div class="border-t-4 border-black mt-2 pt-3 px-4 flex items-center gap-3">
            <div class="w-10 h-10 border-2 border-black bg-surface-container-high flex items-center justify-center">
                <span class="material-symbols-outlined text-primary-container text-xl" style="font-variation-settings: 'FILL' 1;">person</span>
            </div>
            <div>
                <p class="font-headline text-[9px] text-on-surface truncate">{{ auth()->user()->name }}</p>
                <p class="font-headline text-[8px] text-primary-container">LVL {{ auth()->user()->level }}</p>
            </div>
            <span class="rank-badge rank-{{ strtolower(auth()->user()->rank) }} ml-auto" style="font-size: 8px;">
                {{ auth()->user()->rank }}
            </span>
        </div>

        {{-- Logout (mobile) --}}
        <div class="border-t-2 border-outline-variant mt-2 pt-2 px-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="pixel-sidebar-link w-full text-left text-error hover:text-error">
                    <span class="material-symbols-outlined text-lg">logout</span> Logout
                </button>
            </form>
        </div>
    </nav>
</div>

{{-- ============================================
     MAIN CONTENT AREA
     ============================================ --}}
<main class="pt-24 pb-20 px-6 max-w-[1400px] mx-auto">
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
</main>

{{-- ============================================
     BOTTOM ACTION BAR (RPG Command Menu)
     ============================================ --}}
<footer class="fixed bottom-0 w-full h-16 bg-surface-container-low border-t-4 border-black flex justify-center items-center gap-6 sm:gap-12 z-40 px-6 md:hidden">
    <a href="{{ route('student.dashboard') }}"
       class="flex items-center gap-2 font-headline text-[10px] cursor-pointer transition-colors {{ request()->routeIs('student.dashboard') ? 'text-primary-container' : 'text-on-surface hover:text-primary-container' }}">
        <span class="material-symbols-outlined">home</span>
        <span class="hidden sm:inline">HOME</span>
    </a>
    <a href="{{ route('student.guild-select') }}"
       class="flex items-center gap-2 font-headline text-[10px] cursor-pointer transition-colors {{ request()->routeIs('student.guild-select') ? 'text-primary-container' : 'text-on-surface hover:text-primary-container' }}">
        <span class="material-symbols-outlined">fort</span>
        <span class="hidden sm:inline">GUILDS</span>
    </a>
    <a href="{{ route('student.subjects.index') }}"
       class="flex items-center gap-2 font-headline text-[10px] cursor-pointer transition-colors {{ request()->routeIs('student.subjects.*') ? 'text-primary-container' : 'text-on-surface hover:text-primary-container' }}">
        <span class="material-symbols-outlined">menu_book</span>
        <span class="hidden sm:inline">SUBJECTS</span>
    </a>
    <a href="{{ route('student.leaderboard') }}"
       class="flex items-center gap-2 font-headline text-[10px] cursor-pointer transition-colors {{ request()->routeIs('student.leaderboard') ? 'text-primary-container' : 'text-on-surface hover:text-primary-container' }}">
        <span class="material-symbols-outlined">trophy</span>
        <span class="hidden sm:inline">RANKING</span>
    </a>
    <a href="{{ route('student.profile') }}"
       class="flex items-center gap-2 font-headline text-[10px] cursor-pointer transition-colors {{ request()->routeIs('student.profile') ? 'text-primary-container' : 'text-on-surface hover:text-primary-container' }}">
        <span class="material-symbols-outlined">person</span>
        <span class="hidden sm:inline">PROFILE</span>
    </a>
</footer>

{{-- ============================================
     DECORATIVE ELEMENTS
     ============================================ --}}
{{-- Subtle HUD Telemetry (visible only on ultra-wide) --}}
<div class="fixed top-24 left-6 pointer-events-none opacity-20 hidden 2xl:block z-10">
    <span class="font-headline text-[8px] text-primary-container block mb-2">SYS_STABILITY: NOMINAL</span>
    <span class="font-headline text-[8px] text-secondary-container block mb-2">CONNECTION: ENCRYPTED</span>
    <span class="font-headline text-[8px] text-[#3a86ff] block">UPTIME: 04:22:12</span>
</div>
@endsection
