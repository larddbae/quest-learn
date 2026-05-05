@extends('layouts.public')

@section('title', 'Tavern of Support')

@section('public-content')
<main class="max-w-4xl mx-auto px-6 py-24 min-h-[80vh]">
    <div class="bg-surface-container-low border-4 border-black p-8 md:p-12 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h1 class="font-headline text-3xl md:text-4xl text-primary-container uppercase tracking-widest mb-8 border-b-4 border-black pb-4">
            [ TAVERN OF SUPPORT ]
        </h1>
        
        <div class="font-body text-lg text-on-surface space-y-6">
            <p>Welcome to the Tavern, weary traveler. If you have encountered a bug in the matrix or need guidance on your quest, our innkeepers are here to help.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">Report a Glitch</h2>
            <p>Did a monster spawn out of bounds? Did your XP vanish into the void? Send a courier to our support team at <a href="mailto:support@questlearn.io" class="text-primary-container hover:underline">support@questlearn.io</a>.</p>
            
            <h2 class="font-headline text-2xl text-secondary-container mt-8 uppercase">Join the Guild Hall</h2>
            <p>For immediate assistance and community support, join our official Discord server. Here, veteran players and Game Masters alike can aid you in your journey.</p>
            
            <button class="mt-6 bg-primary-container text-black font-headline px-6 py-3 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[4px] active:shadow-none transition-all uppercase tracking-wider">
                [ ENTER DISCORD ]
            </button>
        </div>
    </div>
</main>
@endsection
