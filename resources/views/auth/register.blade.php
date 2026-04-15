@extends('layouts.base')

@section('title', 'Register')

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

        {{-- Register Box --}}
        <div class="pixel-box p-8">
            <h2 class="font-pixel text-sm text-pixel-green text-center mb-6">✚ CREATE CHARACTER</h2>

            @if($errors->any())
                <div class="pixel-alert pixel-alert-error mb-4">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <label class="pixel-label">👤 Player Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="pixel-input" placeholder="Enter your name">
                </div>

                <div class="mb-5">
                    <label class="pixel-label">📧 Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="pixel-input" placeholder="player@questlearn.com">
                </div>

                <div class="mb-5">
                    <label class="pixel-label">🎭 Select Role</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="quiz-option cursor-pointer {{ old('role', 'student') === 'student' ? 'selected' : '' }}">
                            <input type="radio" name="role" value="student" class="hidden"
                                   {{ old('role', 'student') === 'student' ? 'checked' : '' }}
                                   onchange="updateRoleSelection(this)">
                            <div class="text-center w-full">
                                <div class="text-3xl mb-1">🧙</div>
                                <span class="font-pixel text-[9px]">PLAYER</span>
                            </div>
                        </label>
                        <label class="quiz-option cursor-pointer {{ old('role') === 'teacher' ? 'selected' : '' }}">
                            <input type="radio" name="role" value="teacher" class="hidden"
                                   {{ old('role') === 'teacher' ? 'checked' : '' }}
                                   onchange="updateRoleSelection(this)">
                            <div class="text-center w-full">
                                <div class="text-3xl mb-1">🧙‍♂️</div>
                                <span class="font-pixel text-[9px]">GAME MASTER</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="pixel-label">🔑 Password</label>
                    <input type="password" name="password" required
                           class="pixel-input" placeholder="Min 8 characters">
                </div>

                <div class="mb-6">
                    <label class="pixel-label">🔑 Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="pixel-input" placeholder="Repeat password">
                </div>

                <button type="submit" class="pixel-btn pixel-btn-green w-full">
                    ✚ CREATE CHARACTER
                </button>
            </form>
        </div>

        {{-- Login Link --}}
        <div class="text-center mt-6">
            <p class="font-pixel-body text-xl text-pixel-text-muted">
                Already have a character?
                <a href="{{ route('login') }}" class="text-pixel-gold hover:text-pixel-green underline">Login</a>
            </p>
        </div>
    </div>
</div>

<script>
function updateRoleSelection(radio) {
    document.querySelectorAll('.quiz-option').forEach(el => el.classList.remove('selected'));
    radio.closest('.quiz-option').classList.add('selected');
}
</script>
@endsection
