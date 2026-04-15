@extends('layouts.base')

@section('content')
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="pixel-sidebar w-64 flex-shrink-0" id="sidebar">
        <div class="p-4 border-b-4 border-black">
            <a href="{{ route('student.dashboard') }}" class="block">
                <h1 class="font-pixel text-pixel-gold text-xs leading-relaxed">⚔️ QUEST<br>LEARN</h1>
            </a>
        </div>

        <nav class="py-2">
            <a href="{{ route('student.dashboard') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('student.subjects.index') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.subjects.*') ? 'active' : '' }}">
                📚 Subject Hub
            </a>
            <a href="{{ route('student.quest-board') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.quest-board') || request()->routeIs('student.quests.*') ? 'active' : '' }}">
                🗺️ Quest Board
            </a>
            <a href="{{ route('student.learning-room') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.learning-room') || request()->routeIs('student.materials.*') ? 'active' : '' }}">
                📜 Learning Room
            </a>
            <a href="{{ route('student.quiz-arena') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.quiz-arena') || request()->routeIs('student.quizzes.*') ? 'active' : '' }}">
                ⚔️ Quiz Arena
            </a>
            <a href="{{ route('student.profile') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                🎒 Profile & Inventory
            </a>
            <a href="{{ route('student.leaderboard') }}"
               class="pixel-sidebar-link {{ request()->routeIs('student.leaderboard') ? 'active' : '' }}">
                🏆 Leaderboard
            </a>
        </nav>

        {{-- Player Mini Status --}}
        <div class="mt-auto p-4 border-t-4 border-black">
            <div class="text-center">
                <div class="text-4xl mb-2">{{ auth()->user()->avatar ?? '🧙' }}</div>
                <p class="font-pixel text-[9px] text-pixel-text truncate">{{ auth()->user()->name }}</p>
                <p class="font-pixel-body text-lg text-pixel-gold mt-1">LVL {{ auth()->user()->level }}</p>
                <span class="rank-badge rank-{{ strtolower(auth()->user()->rank) }} mt-1" style="font-size: 8px;">
                    {{ auth()->user()->rank }}
                </span>
            </div>
        </div>

        {{-- Logout --}}
        <div class="p-4 border-t-2 border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="pixel-sidebar-link w-full text-left text-pixel-red hover:text-pixel-red">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6 overflow-y-auto">
        {{-- Mobile Menu Button --}}
        <button onclick="document.getElementById('sidebar').classList.toggle('open')"
                class="md:hidden pixel-btn pixel-btn-gold pixel-btn-sm mb-4">
            ☰ MENU
        </button>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="pixel-alert pixel-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="pixel-alert pixel-alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="pixel-alert pixel-alert-info">{{ session('info') }}</div>
        @endif

        @yield('main')
    </main>
</div>
@endsection
