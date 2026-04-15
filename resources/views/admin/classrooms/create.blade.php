@extends('layouts.admin')

@section('title', 'Create Guild')

@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.classrooms.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">
        ◀ BACK TO GUILDS
    </a>

    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✚ CREATE NEW GUILD</h1>

        <form method="POST" action="{{ route('admin.classrooms.store') }}">
            @csrf

            <div class="mb-5">
                <label class="pixel-label">🏰 Guild Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="pixel-input" placeholder="e.g., Class 10A - Warriors">
                @error('name') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea" placeholder="Optional description...">{{ old('description') }}</textarea>
            </div>

            <div class="pixel-alert pixel-alert-info mb-6">
                A 6-character JOIN CODE will be auto-generated. Share it with your players!
            </div>

            <button type="submit" class="pixel-btn pixel-btn-gold w-full">⚔️ FORGE GUILD</button>
        </form>
    </div>
</div>
@endsection
