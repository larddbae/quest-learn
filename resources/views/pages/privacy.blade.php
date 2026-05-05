@extends('layouts.public')

@section('title', 'The Scroll of Privacy')

@section('public-content')
<main class="max-w-4xl mx-auto px-6 py-24 min-h-[80vh]">
    <div class="bg-surface-container-low border-4 border-black p-8 md:p-12 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h1 class="font-headline text-3xl md:text-4xl text-primary-container uppercase tracking-widest mb-8 border-b-4 border-black pb-4">
            [ THE SCROLL OF PRIVACY ]
        </h1>
        
        <div class="font-body text-lg text-on-surface space-y-6">
            <p>Your secrets are safe within our enchanted vaults. This scroll details how we protect your personal artifacts.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">1. Data Collection Spells</h2>
            <p>We only collect the essence required to maintain your character profile and track your quest progress. No dark rituals are performed with your data.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">2. The Vault of Security</h2>
            <p>Your data is protected by high-level encryption spells. Even the most cunning rogues cannot breach our digital fortress.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">3. Information Sharing</h2>
            <p>We do not trade your information with traveling merchants or third-party guilds without your explicit consent.</p>
        </div>
    </div>
</main>
@endsection
