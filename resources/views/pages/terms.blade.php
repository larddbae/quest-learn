@extends('layouts.public')

@section('title', 'The Sacred Terms of Service')

@section('public-content')
<main class="max-w-4xl mx-auto px-6 py-24 min-h-[80vh]">
    <div class="bg-surface-container-low border-4 border-black p-8 md:p-12 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h1 class="font-headline text-3xl md:text-4xl text-primary-container uppercase tracking-widest mb-8 border-b-4 border-black pb-4">
            [ THE SACRED TERMS ]
        </h1>
        
        <div class="font-body text-lg text-on-surface space-y-6">
            <p>Welcome, Adventurer, to QuestLearn. By entering this realm, you agree to abide by the ancient laws set forth in these scrolls.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">1. The Code of Conduct</h2>
            <p>All heroes must treat their fellow guild members with respect. Any form of griefing, trolling, or dark magic (cheating) will result in immediate banishment to the shadow realm.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">2. Loot and Experience</h2>
            <p>Experience points (XP) and loot earned during your quests are non-transferable. You cannot sell your account to the highest bidder in the grand exchange.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">3. Game Master Authority</h2>
            <p>The Game Masters (Teachers) hold absolute power over their realms. Their decisions are final in all disputes.</p>
        </div>
    </div>
</main>
@endsection
