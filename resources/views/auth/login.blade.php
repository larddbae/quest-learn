@extends('layouts.guest')

@section('title', 'Player Login')

@section('guest-content')


{{-- Main Content --}}
<main class="relative flex flex-col items-center justify-center min-h-screen pt-24 pb-32 px-4">
    {{-- Background Ambiance --}}
    <div class="absolute inset-0 z-0 bg-[#0D0D2B]">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#3a3000 1px, transparent 1px); background-size: 20px 20px;"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center max-w-lg w-full">
        {{-- Error Banner --}}
        @if($errors->any())
            <div class="mb-8 w-full bg-error-container border-4 border-black p-3 text-center pixel-shadow animate-pulse">
                <div class="flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-on-error-container">warning</span>
                    <p class="font-headline text-[10px] text-on-error-container uppercase leading-tight">
                        ⚠ {{ $errors->first() }}
                    </p>
                </div>
            </div>
        @endif

        <div class="flex items-end justify-center w-full gap-8 mb-4">
            {{-- Decorative Left Torch --}}
            <div class="hidden md:flex flex-col items-center">
                <div class="w-8 h-12 bg-orange-500 border-x-4 border-t-4 border-black relative">
                    <div class="absolute -top-6 left-0 right-0 h-8 bg-yellow-400 animate-bounce"></div>
                </div>
                <div class="w-4 h-16 bg-surface-container-highest border-x-4 border-b-4 border-black"></div>
            </div>

            {{-- Login Card --}}
            <div class="flex-1 bg-[#1A1A3E] border-4 border-black p-8 pixel-shadow-8">
                <div class="flex flex-col items-center mb-8 border-b-4 border-black pb-6">
                    <div class="w-16 h-16 bg-surface-container-high border-4 border-black flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">shield_person</span>
                    </div>
                    <h1 class="font-headline text-primary-container text-lg tracking-tighter text-center uppercase">
                        [ PLAYER LOGIN ]
                    </h1>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email Field --}}
                    <div class="space-y-2">
                        <label class="block font-body text-xl text-on-surface uppercase flex items-center gap-2">
                            <span class="text-primary-container">▶</span> EMAIL ADDRESS
                        </label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                                   placeholder="HERO@DOMAIN.COM">
                        </div>
                    </div>

                    {{-- Password Field --}}
                    <div class="space-y-2">
                        <label class="block font-body text-xl text-on-surface uppercase flex items-center gap-2">
                            <span class="text-primary-container">▶</span> PASSWORD
                            <span class="material-symbols-outlined text-sm ml-auto text-surface-variant">lock</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" required
                                   class="w-full bg-surface-container-lowest border-4 border-black p-4 text-on-surface font-body text-xl focus:ring-0 focus:border-secondary-container transition-colors outline-none placeholder:text-surface-variant"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="remember" id="remember"
                               class="w-5 h-5 bg-surface-container-lowest border-2 border-black accent-primary-container">
                        <label for="remember" class="font-body text-lg text-on-surface-variant cursor-pointer uppercase">Remember Me</label>
                    </div>

                    {{-- Submit Button --}}
                    <x-pixel-button variant="gold" type="submit" :full="true" size="md">
                        [ ENTER DUNGEON ]
                    </x-pixel-button>
                </form>

                {{-- Register Link --}}
                <div class="mt-8 text-center border-t-4 border-black pt-6">
                    <p class="font-body text-xl text-on-surface">
                        New adventurer?
                        <a class="text-secondary-container hover:underline underline-offset-4 ml-2 uppercase" href="{{ route('register') }}">
                            [ REGISTER HERE ]
                        </a>
                    </p>
                </div>
            </div>

            {{-- Decorative Right Torch --}}
            <div class="hidden md:flex flex-col items-center">
                <div class="w-8 h-12 bg-orange-500 border-x-4 border-t-4 border-black relative">
                    <div class="absolute -top-6 left-0 right-0 h-8 bg-yellow-400 animate-bounce" style="animation-delay: 0.2s;"></div>
                </div>
                <div class="w-4 h-16 bg-surface-container-highest border-x-4 border-b-4 border-black"></div>
            </div>
        </div>

        {{-- Footer Stats --}}
        <div class="mt-8 flex gap-4 w-full justify-center">
            <div class="bg-surface-container-low border-2 border-outline-variant px-3 py-1 flex items-center gap-2">
                <span class="w-2 h-2 bg-secondary-container"></span>
                <span class="font-headline text-[8px] text-on-surface-variant uppercase">Server: ONLINE</span>
            </div>
            <div class="bg-surface-container-low border-2 border-outline-variant px-3 py-1 flex items-center gap-2">
                <span class="w-2 h-2 bg-primary-container"></span>
                <span class="font-headline text-[8px] text-on-surface-variant uppercase">Ver: 0.8.2-BETA</span>
            </div>
        </div>
    </div>
</main>
@endsection
