@extends('layouts.admin')
@section('title', 'Create Subject')
@section('main')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.subjects.index', $classroom) }}" class="font-pixel text-[9px] text-pixel-text-muted hover:text-pixel-gold mb-4 inline-block">◀ SUBJECTS</a>
    <div class="pixel-box p-8">
        <h1 class="font-pixel text-sm text-pixel-gold mb-6 text-center">✚ NEW SUBJECT</h1>
        <form method="POST" action="{{ route('admin.subjects.store', $classroom) }}">
            @csrf
            <div class="mb-5">
                <label class="pixel-label">📖 Subject Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="pixel-input" placeholder="e.g., Mathematics">
                @error('name') <p class="font-pixel text-[8px] text-pixel-red mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="pixel-label">📝 Description</label>
                <textarea name="description" class="pixel-textarea" placeholder="What will students learn?">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="pixel-btn pixel-btn-gold w-full">✚ CREATE SUBJECT</button>
        </form>
    </div>
</div>
@endsection
