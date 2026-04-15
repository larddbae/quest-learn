@extends('layouts.base')

@section('title', 'Join a Guild')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="text-5xl mb-3 animate-float">🏰</div>
            <h1 class="font-pixel text-pixel-gold text-sm">JOIN A GUILD</h1>
            <p class="font-pixel-body text-xl text-pixel-text-muted mt-2">
                Enter the 6-character code from your Game Master
            </p>
        </div>

        <div class="pixel-box p-8">
            @if($errors->any())
                <div class="pixel-alert pixel-alert-error mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('student.join-class.submit') }}">
                @csrf

                <div class="mb-6">
                    <label class="pixel-label">🔑 Guild Code</label>
                    <input type="text" name="join_code" value="{{ old('join_code') }}" required autofocus
                           class="pixel-input text-center text-3xl tracking-[0.5em] uppercase"
                           placeholder="ABCDEF" maxlength="6" style="font-family: 'Press Start 2P', monospace;">
                </div>

                <button type="submit" class="pixel-btn pixel-btn-gold w-full">
                    ⚔️ JOIN GUILD
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="font-pixel-body text-xl text-pixel-text-muted hover:text-pixel-red underline">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
