@extends('layouts.base')

@section('content')
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="pixel-sidebar w-64 flex-shrink-0" id="admin-sidebar">
        <div class="p-4 border-b-4 border-black">
            <a href="{{ route('admin.dashboard') }}" class="block">
                <h1 class="font-pixel text-pixel-gold text-xs leading-relaxed">⚔️ QUEST<br>LEARN</h1>
                <span class="font-pixel text-[8px] text-pixel-purple mt-1 block">GAME MASTER</span>
            </a>
        </div>

        <nav class="py-2">
            <a href="{{ route('admin.dashboard') }}"
               class="pixel-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                🏰 Dashboard
            </a>
            <a href="{{ route('admin.classrooms.index') }}"
               class="pixel-sidebar-link {{ request()->routeIs('admin.classrooms.*') ? 'active' : '' }}">
                ⚔️ Guilds
            </a>
            <a href="{{ route('admin.quest-builder') }}"
               class="pixel-sidebar-link {{ request()->routeIs('admin.quest-builder') || request()->routeIs('admin.subjects.*') || request()->routeIs('admin.quests.*') || request()->routeIs('admin.materials.*') || request()->routeIs('admin.quizzes.*') ? 'active' : '' }}">
                🛠️ Quest Builder
            </a>
            <a href="{{ route('admin.badges.index') }}"
               class="pixel-sidebar-link {{ request()->routeIs('admin.badges.*') ? 'active' : '' }}">
                🏅 Badge Forge
            </a>
        </nav>

        {{-- GM Info --}}
        <div class="mt-auto p-4 border-t-4 border-black">
            <div class="text-center">
                <div class="text-3xl mb-2">🧙‍♂️</div>
                <p class="font-pixel text-[9px] text-pixel-text truncate">{{ auth()->user()->name }}</p>
                <p class="font-pixel text-[8px] text-pixel-purple mt-1">GAME MASTER</p>
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
        <button onclick="document.getElementById('admin-sidebar').classList.toggle('open')"
                class="md:hidden pixel-btn pixel-btn-purple pixel-btn-sm mb-4">
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
