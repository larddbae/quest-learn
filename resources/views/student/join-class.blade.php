@extends('layouts.base')

@section('title', 'Join Your Guild')

@section('content')
<div class="min-h-screen relative flex flex-col items-center justify-center overflow-hidden">
    {{-- Dithered Background --}}
    <div class="fixed inset-0 dithered-bg opacity-10 pointer-events-none"></div>

    {{-- Floating Decorative Icons --}}
    <div class="absolute inset-0 z-10 pointer-events-none">
        <span class="material-symbols-outlined text-primary-container absolute top-[15%] left-[20%] text-4xl opacity-60" style="font-variation-settings: 'FILL' 1;">star</span>
        <span class="material-symbols-outlined text-primary-container absolute top-[25%] right-[15%] text-2xl opacity-40" style="font-variation-settings: 'FILL' 1;">star</span>
        <span class="material-symbols-outlined text-primary-container absolute bottom-[30%] right-[25%] text-5xl opacity-50" style="font-variation-settings: 'FILL' 1;">monetization_on</span>
    </div>

    {{-- Main Panel --}}
    <main class="relative z-20 w-full max-w-2xl px-6">
        {{-- Center Card --}}
        <div class="bg-[#1A1A3E] border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] pixel-box-glow p-10 flex flex-col items-center text-center">
            {{-- Header Group --}}
            <div class="mb-8">
                <div class="mb-4 inline-block p-4 bg-surface-container-high border-4 border-black">
                    <span class="material-symbols-outlined text-primary-container text-6xl" style="font-variation-settings: 'FILL' 1;">fort</span>
                </div>
                <h1 class="font-headline text-primary-container text-xl md:text-2xl tracking-widest leading-relaxed">
                    [ JOIN YOUR GUILD ]
                </h1>
                <p class="font-body text-on-background text-2xl mt-4 max-w-md">
                    Enter the 6-character Join Code given by your Game Master (teacher).
                </p>
            </div>

            {{-- Error Display --}}
            @if($errors->any())
                <div class="mb-6 w-full bg-error-container border-4 border-black p-3 text-center pixel-shadow">
                    <div class="flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined text-on-error-container">warning</span>
                        <p class="font-headline text-[10px] text-on-error-container uppercase leading-tight">
                            ⚠ {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- Form with Join Code Input --}}
            <form method="POST" action="{{ route('student.join-class.submit') }}" class="w-full flex flex-col items-center">
                @csrf

                {{-- Join Code Input --}}
                <div class="mb-10 w-full flex justify-center">
                    <input type="text" name="join_code" value="{{ old('join_code') }}" required autofocus
                           maxlength="6"
                           class="w-full max-w-sm bg-surface-container-lowest border-4 border-black p-5 text-center text-on-surface font-headline text-2xl md:text-3xl tracking-[0.4em] uppercase focus:ring-0 focus:border-primary-container outline-none placeholder:text-surface-variant placeholder:tracking-[0.3em] placeholder:text-lg shadow-[2px_2px_0_0_rgba(0,0,0,1)]"
                           placeholder="ENTER CODE"
                           style="letter-spacing: 0.4em;">
                </div>

                {{-- Submit Button --}}
                <x-pixel-button variant="gold" type="submit" size="lg">
                    [ ENTER GUILD ]
                </x-pixel-button>
            </form>

            {{-- Footer Info --}}
            <div class="border-t-2 border-outline-variant w-full pt-6 mt-8">
                <p class="font-body text-on-surface-variant text-xl flex items-center justify-center gap-2">
                    <span class="text-primary-container">▶</span> Code not working? Contact your teacher.
                </p>
            </div>
        </div>

        {{-- System Stats Panels --}}
        <div class="mt-8 flex flex-col sm:flex-row justify-between gap-4">
            <div class="bg-surface-container-low border-4 border-black p-3 flex-1 flex items-center gap-3">
                <div class="w-8 h-8 bg-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-secondary-container text-xl">shield</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline text-[8px] text-secondary-container">SECURITY</span>
                    <span class="font-body text-white">ENCRYPTED HUD</span>
                </div>
            </div>
            <div class="bg-surface-container-low border-4 border-black p-3 flex-1 flex items-center gap-3">
                <div class="w-8 h-8 bg-tertiary-fixed-dim flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-tertiary-fixed-variant text-xl">wifi</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline text-[8px] text-tertiary-fixed-dim">SIGNAL</span>
                    <span class="font-body text-white">LINK ACTIVE</span>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="mt-6 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="font-body text-xl text-on-surface-variant hover:text-error transition-colors underline underline-offset-4 uppercase">
                    <span class="material-symbols-outlined text-sm align-middle mr-1">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </main>

    {{-- Bottom Action Bar --}}
    <footer class="fixed bottom-0 w-full h-12 bg-surface-container-lowest border-t-4 border-black z-40 flex items-center px-6 justify-between">
        <div class="flex items-center gap-4">
            <div class="font-headline text-[10px] text-primary-container">QUESTLEARN V2.4</div>
            <div class="h-4 w-px bg-outline-variant"></div>
            <div class="font-body text-on-surface-variant text-lg uppercase">Awaiting credentials...</div>
        </div>
        <div class="flex gap-4">
            <span class="material-symbols-outlined text-on-surface-variant text-xl cursor-pointer hover:text-white">settings</span>
            <span class="material-symbols-outlined text-on-surface-variant text-xl cursor-pointer hover:text-white">help_outline</span>
        </div>
    </footer>
</div>
@endsection
