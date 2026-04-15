@extends('layouts.base')

@section('title', 'QuestLearn — Level Up Your Knowledge')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center p-4 pixel-grid-bg">
    {{-- Main Title --}}
    <div class="text-center mb-12 animate-float">
        <div class="text-6xl mb-4">⚔️</div>
        <h1 class="font-pixel text-pixel-gold text-2xl md:text-3xl mb-4 leading-relaxed">
            QUEST<span class="text-pixel-green">LEARN</span>
        </h1>
        <p class="font-pixel text-pixel-text-muted text-[10px] tracking-wider">
            LEVEL UP YOUR KNOWLEDGE, TRACK YOUR GUILD
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-12">
        <a href="{{ route('login') }}" class="pixel-btn pixel-btn-gold text-center min-w-[200px]">
            ▶ START GAME
        </a>
        <a href="{{ route('register') }}" class="pixel-btn pixel-btn-green text-center min-w-[200px]">
            ✚ NEW PLAYER
        </a>
    </div>

    {{-- Feature Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl w-full">
        <div class="pixel-box p-6 text-center">
            <div class="text-4xl mb-3">📚</div>
            <h3 class="font-pixel text-[10px] text-pixel-gold mb-2">QUESTS</h3>
            <p class="font-pixel-body text-lg text-pixel-text-muted">Complete learning quests to earn XP and level up your character.</p>
        </div>
        <div class="pixel-box p-6 text-center">
            <div class="text-4xl mb-3">🏆</div>
            <h3 class="font-pixel text-[10px] text-pixel-gold mb-2">COMPETE</h3>
            <p class="font-pixel-body text-lg text-pixel-text-muted">Climb the guild leaderboard and earn rare achievement badges.</p>
        </div>
        <div class="pixel-box p-6 text-center">
            <div class="text-4xl mb-3">⚔️</div>
            <h3 class="font-pixel text-[10px] text-pixel-gold mb-2">GUILDS</h3>
            <p class="font-pixel-body text-lg text-pixel-text-muted">Join your classroom guild and track progress with your team.</p>
        </div>
    </div>

    {{-- Footer --}}
    <div class="mt-12 text-center">
        <p class="font-pixel text-[8px] text-pixel-text-muted">
            &copy; {{ date('Y') }} QUESTLEARN — PRESS START TO BEGIN
        </p>
    </div>
</div>
@endsection
