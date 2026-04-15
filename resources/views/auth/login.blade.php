@extends('layouts.base')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Header --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <div class="text-5xl mb-3 animate-float">⚔️</div>
                <h1 class="font-pixel text-pixel-gold text-lg">QUEST<span class="text-pixel-green">LEARN</span></h1>
            </a>
        </div>

        {{-- Login Box --}}
        <div class="pixel-box p-8">
            <h2 class="font-pixel text-sm text-pixel-gold text-center mb-6">▶ LOGIN</h2>

            @if($errors->any())
                <div class="pixel-alert pixel-alert-error mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label class="pixel-label">📧 Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="pixel-input" placeholder="player@questlearn.com">
                </div>

                <div class="mb-5">
                    <label class="pixel-label">🔑 Password</label>
                    <input type="password" name="password" required
                           class="pixel-input" placeholder="••••••••">
                </div>

                <div class="mb-6 flex items-center gap-3">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-5 h-5 accent-yellow-400">
                    <label for="remember" class="font-pixel-body text-lg text-pixel-text-muted cursor-pointer">Remember Me</label>
                </div>

                <button type="submit" class="pixel-btn pixel-btn-gold w-full">
                    ▶ START GAME
                </button>
            </form>
        </div>

        {{-- Register Link --}}
        <div class="text-center mt-6">
            <p class="font-pixel-body text-xl text-pixel-text-muted">
                New player?
                <a href="{{ route('register') }}" class="text-pixel-green hover:text-pixel-gold underline">Create Account</a>
            </p>
        </div>
    </div>
</div>
@endsection
