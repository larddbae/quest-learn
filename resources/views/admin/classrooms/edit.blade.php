@extends('layouts.admin')

@section('title', 'Edit Guild')

@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.classrooms.index') }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">
        ◀ BACK TO GUILDS
    </a>

    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✏️ EDIT GUILD</h1>

        <form method="POST" action="{{ route('admin.classrooms.update', $classroom) }}">
            @csrf @method('PUT')

            <div class="mb-5">
                <label class="pixel-label">🏰 Guild Name</label>
                <input type="text" name="name" value="{{ old('name', $classroom->name) }}" required class="pixel-input">
                @error('name') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea">{{ old('description', $classroom->description) }}</textarea>
            </div>

            <div class="pixel-box-light p-4 mb-6 text-center">
                <span class="font-pixel text-[9px] text-pixel-text-muted">JOIN CODE: </span>
                <span class="font-pixel text-sm text-pixel-gold">{{ $classroom->join_code }}</span>
            </div>

            <button type="submit" class="pixel-btn pixel-btn-gold w-full">💾 SAVE CHANGES</button>
        </form>
    </div>
</div>
@endsection
