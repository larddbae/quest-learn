@extends('layouts.public')

@section('title', 'Create Your Character')

@section('public-content')
<div class="min-h-screen flex items-center justify-center pt-24 pb-32 px-4 overflow-x-hidden relative">
    {{-- Background Dot Grid --}}
    <div class="fixed inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#1c1c3b 1px, transparent 1px); background-size: 20px 20px;"></div>

    {{-- Floating Decorative Icons --}}
    <div class="fixed top-10 left-10 opacity-60 pointer-events-none">
        <span class="material-symbols-outlined text-primary-container text-3xl animate-bounce" style="font-variation-settings: 'FILL' 1;">monetization_on</span>
    </div>
    <div class="fixed top-20 right-20 opacity-40 pointer-events-none">
        <span class="material-symbols-outlined text-primary-container text-2xl animate-pulse" style="font-variation-settings: 'FILL' 1;">monetization_on</span>
    </div>
    <div class="fixed top-60 left-1/4 opacity-30 pointer-events-none">
        <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">monetization_on</span>
    </div>

    {{-- Registration Panel --}}
    <main class="relative z-10 w-full max-w-lg bg-surface-container-low border-4 border-black pixel-shadow p-8 md:p-12">
        {{-- Header --}}
        <header class="text-center mb-10">
            <h1 class="font-headline text-primary-container text-xl md:text-2xl tracking-widest uppercase mb-8">
                [ CREATE CHARACTER ]
            </h1>

            {{-- Role Selection as Character Cards --}}
            <div class="flex justify-center gap-4 mb-4">
                <label class="bg-surface-container border-4 border-black p-3 cursor-pointer group transition-all
                              {{ old('role', 'student') === 'student' ? 'border-secondary-container bg-surface-container-high' : '' }}"
                       id="role-label-student">
                    <input type="radio" name="role" value="student" form="register-form" class="hidden"
                           {{ old('role', 'student') === 'student' ? 'checked' : '' }}
                           onchange="updateRoleSelection(this)">
                    <div class="w-12 h-12 flex items-center justify-center mb-1 {{ old('role', 'student') === 'student' ? '' : 'grayscale group-hover:grayscale-0' }}">
                        <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                    <span class="block font-body text-xs mt-1 {{ old('role', 'student') === 'student' ? 'text-secondary-container' : 'text-on-surface' }}">Player</span>
                </label>

                <label class="bg-surface-container border-4 border-black p-3 cursor-pointer group transition-all
                              {{ old('role') === 'teacher' ? 'border-secondary-container bg-surface-container-high' : '' }}"
                       id="role-label-teacher">
                    <input type="radio" name="role" value="teacher" form="register-form" class="hidden"
                           {{ old('role') === 'teacher' ? 'checked' : '' }}
                           onchange="updateRoleSelection(this)">
                    <div class="w-12 h-12 flex items-center justify-center mb-1 {{ old('role') === 'teacher' ? '' : 'grayscale group-hover:grayscale-0' }}">
                        <span class="material-symbols-outlined text-primary-container text-4xl" style="font-variation-settings: 'FILL' 1;">shield_person</span>
                    </div>
                    <span class="block font-body text-xs mt-1 {{ old('role') === 'teacher' ? 'text-secondary-container' : 'text-on-surface' }}">Game Master</span>
                </label>
            </div>

            <p class="font-body text-[#3a86ff] uppercase tracking-tighter" id="role-display">
                Class Selected: {{ old('role', 'student') === 'teacher' ? 'Game Master' : 'Apprentice Player' }}
            </p>
        </header>

        {{-- Error Display --}}
        @if($errors->any())
            <div class="mb-6 bg-error-container border-4 border-black p-3 pixel-shadow">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-on-error-container">warning</span>
                    <div class="font-headline text-[10px] text-on-error-container uppercase leading-tight">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-6" id="register-form">
            @csrf

            {{-- Player Name --}}
            <div class="space-y-2">
                <label class="font-body text-white text-lg flex items-center gap-2">
                    <span class="text-secondary-container">▶</span> PLAYER NAME
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full bg-surface-container-lowest border-4 border-black text-on-background font-body text-xl p-4 focus:border-secondary-container focus:ring-0 outline-none placeholder:opacity-30"
                       placeholder="Enter Hero Name...">
            </div>

            {{-- Email Address --}}
            <div class="space-y-2">
                <label class="font-body text-white text-lg flex items-center gap-2">
                    <span class="text-secondary-container">▶</span> EMAIL ADDRESS
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-surface-container-lowest border-4 border-black text-on-background font-body text-xl p-4 focus:border-secondary-container focus:ring-0 outline-none placeholder:opacity-30"
                       placeholder="hero@questlearn.io">
            </div>

            {{-- Password --}}
            <div class="space-y-2">
                <label class="font-body text-white text-lg flex items-center gap-2">
                    <span class="text-secondary-container">▶</span> PASSWORD
                </label>
                <div class="relative">
                    <input type="password" name="password" required id="password-field"
                           class="w-full bg-surface-container-lowest border-4 border-black text-on-background font-body text-xl p-4 focus:border-secondary-container focus:ring-0 outline-none"
                           placeholder="Min 8 characters">
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-background hover:text-primary-container transition-colors"
                            onclick="togglePassword()">
                        <span class="material-symbols-outlined" id="password-toggle-icon">visibility</span>
                    </button>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-2">
                <label class="font-body text-white text-lg flex items-center gap-2">
                    <span class="text-secondary-container">▶</span> CONFIRM PASSWORD
                </label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-surface-container-lowest border-4 border-black text-on-background font-body text-xl p-4 focus:border-secondary-container focus:ring-0 outline-none"
                       placeholder="Repeat password">
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <x-pixel-button variant="green" type="submit" :full="true" size="lg" icon="auto_fix_high">
                    [ FORGE CHARACTER ]
                </x-pixel-button>
            </div>
        </form>

        {{-- Login Link --}}
        <footer class="mt-8 text-center">
            <p class="font-body text-on-surface text-lg">
                Already a hero?
                <a class="text-[#3a86ff] hover:underline decoration-4 decoration-black" href="{{ route('login') }}">
                    [ SIGN IN ]
                </a>
            </p>
        </footer>

        {{-- Corner Ornaments --}}
        <div class="absolute -top-2 -left-2 w-6 h-6 bg-primary-container border-2 border-black"></div>
        <div class="absolute -top-2 -right-2 w-6 h-6 bg-primary-container border-2 border-black"></div>
        <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-primary-container border-2 border-black"></div>
        <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-primary-container border-2 border-black"></div>
    </main>

    {{-- HUD Version Tag --}}
    <div class="fixed bottom-4 right-4 font-body text-[#3a86ff] text-sm opacity-50 pointer-events-none">
        HUD v2.0.4 // REGISTRATION_PROTOCOL_ACTIVE
    </div>
</div>

<script>
function updateRoleSelection(radio) {
    // Reset all labels
    document.querySelectorAll('[id^="role-label-"]').forEach(label => {
        label.classList.remove('border-secondary-container', 'bg-surface-container-high');
        label.classList.add('border-black');
        label.querySelector('span:last-child').classList.remove('text-secondary-container');
        label.querySelector('span:last-child').classList.add('text-on-surface');
        const iconDiv = label.querySelector('div');
        if (iconDiv) {
            iconDiv.classList.add('grayscale');
        }
    });

    // Highlight selected label
    const selectedLabel = radio.closest('label');
    selectedLabel.classList.remove('border-black');
    selectedLabel.classList.add('border-secondary-container', 'bg-surface-container-high');
    selectedLabel.querySelector('span:last-child').classList.remove('text-on-surface');
    selectedLabel.querySelector('span:last-child').classList.add('text-secondary-container');
    const iconDiv = selectedLabel.querySelector('div');
    if (iconDiv) {
        iconDiv.classList.remove('grayscale');
    }

    // Update role display text
    const display = document.getElementById('role-display');
    if (radio.value === 'teacher') {
        display.textContent = 'Class Selected: Game Master';
    } else {
        display.textContent = 'Class Selected: Apprentice Player';
    }
}

function togglePassword() {
    const field = document.getElementById('password-field');
    const icon = document.getElementById('password-toggle-icon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        field.type = 'password';
        icon.textContent = 'visibility';
    }
}
</script>
@endsection
