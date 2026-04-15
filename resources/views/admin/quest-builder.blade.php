@extends('layouts.admin')

@section('title', 'Quest Builder')

@section('main')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="pixel-box p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-pixel text-lg text-pixel-gold mb-2">🛠️ QUEST BUILDER</h1>
                <p class="font-pixel-body text-xl text-pixel-text-muted">
                    Create and manage Subjects, Quests, Materials, and Quizzes across all your guilds.
                </p>
            </div>
        </div>
    </div>

    {{-- Stats Bar --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-gold">{{ $totalSubjects }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">SUBJECTS</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-green">{{ $totalQuests }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">QUESTS</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-cyan">{{ $totalMaterials }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">MATERIALS</p>
        </div>
        <div class="pixel-box p-4 text-center">
            <p class="font-pixel text-xl text-pixel-purple">{{ $totalQuizzes }}</p>
            <p class="font-pixel text-[8px] text-pixel-text-muted mt-1">QUIZ QUESTIONS</p>
        </div>
    </div>

    @if($classrooms->isEmpty())
        <div class="pixel-box p-12 text-center">
            <div class="text-6xl mb-4">🏰</div>
            <h2 class="font-pixel text-sm text-pixel-text-muted mb-2">NO GUILDS YET</h2>
            <p class="font-pixel-body text-xl text-pixel-text-muted mb-4">
                Create a guild first, then you can start building quests!
            </p>
            <a href="{{ route('admin.classrooms.create') }}" class="pixel-btn pixel-btn-gold">✚ CREATE GUILD</a>
        </div>
    @else
        {{-- Tree View per Classroom --}}
        @foreach($classrooms as $classroom)
            <div class="pixel-box p-6 mb-6">
                {{-- Classroom Header --}}
                <div class="flex items-center justify-between mb-4 pb-4 border-b-2 border-white/10">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🏰</span>
                        <div>
                            <h2 class="font-pixel text-sm text-pixel-gold">{{ $classroom->name }}</h2>
                            <p class="font-pixel text-[8px] text-pixel-text-muted">CODE: {{ $classroom->join_code }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.subjects.create', $classroom) }}" class="pixel-btn pixel-btn-green pixel-btn-sm">
                        ✚ ADD SUBJECT
                    </a>
                </div>

                @if($classroom->subjects->isEmpty())
                    <div class="text-center p-6">
                        <p class="font-pixel text-[9px] text-pixel-text-muted">No subjects in this guild yet.</p>
                    </div>
                @else
                    {{-- Subjects --}}
                    @foreach($classroom->subjects as $subject)
                        <div class="mb-6 last:mb-0">
                            {{-- Subject Header --}}
                            <div class="flex items-center justify-between mb-3 pl-6 border-l-4 border-pixel-gold">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ $subject->icon ?? '📖' }}</span>
                                    <div>
                                        <h3 class="font-pixel text-[11px] text-pixel-text">{{ $subject->name }}</h3>
                                        <p class="font-pixel text-[8px] text-pixel-text-muted">{{ $subject->quests_count }} quests</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.quests.create', $subject) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✚ QUEST</a>
                                    <a href="{{ route('admin.subjects.edit', [$classroom, $subject]) }}" class="pixel-btn pixel-btn-blue pixel-btn-sm">✏️</a>
                                    <form method="POST" action="{{ route('admin.subjects.destroy', [$classroom, $subject]) }}" class="inline"
                                          onsubmit="return confirm('Delete this subject and all its quests?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                                    </form>
                                </div>
                            </div>

                            {{-- Quests --}}
                            @if($subject->quests->isEmpty())
                                <div class="pl-12 mb-3">
                                    <p class="font-pixel text-[8px] text-pixel-text-muted">No quests yet.</p>
                                </div>
                            @else
                                <div class="pl-12 space-y-3">
                                    @foreach($subject->quests as $quest)
                                        <div class="pixel-box-light p-4">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-3">
                                                    <span class="text-xl">⚔️</span>
                                                    <div>
                                                        <h4 class="font-pixel text-[10px] text-pixel-text">
                                                            #{{ $quest->order }} — {{ $quest->title }}
                                                        </h4>
                                                        <span class="font-pixel text-[8px] text-pixel-gold">🌟 {{ $quest->xp_reward }} XP</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.quests.edit', [$subject, $quest]) }}" class="pixel-btn pixel-btn-gold pixel-btn-sm">✏️</a>
                                                    <form method="POST" action="{{ route('admin.quests.destroy', [$subject, $quest]) }}" class="inline"
                                                          onsubmit="return confirm('Delete this quest?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="pixel-btn pixel-btn-red pixel-btn-sm">🗑️</button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- Material & Quiz Status --}}
                                            <div class="flex items-center gap-4 pl-8 mt-2">
                                                @if($quest->material)
                                                    <a href="{{ route('admin.materials.edit', $quest) }}" class="flex items-center gap-2 group">
                                                        <span class="font-pixel text-[8px] text-pixel-green">✅ MATERIAL</span>
                                                        <span class="font-pixel text-[7px] text-pixel-text-muted group-hover:text-pixel-gold">
                                                            "{{ Str::limit($quest->material->title, 30) }}"
                                                        </span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.materials.create', $quest) }}" class="pixel-btn pixel-btn-green pixel-btn-sm" style="font-size: 7px; padding: 4px 10px;">
                                                        ✚ ADD MATERIAL
                                                    </a>
                                                @endif

                                                <span class="text-pixel-text-muted">|</span>

                                                @if($quest->material && $quest->material->quizzes->count() > 0)
                                                    <a href="{{ route('admin.quizzes.index', $quest) }}" class="flex items-center gap-2 group">
                                                        <span class="font-pixel text-[8px] text-pixel-purple">📝 {{ $quest->material->quizzes->count() }} QUIZZES</span>
                                                    </a>
                                                @elseif($quest->material)
                                                    <a href="{{ route('admin.quizzes.create', $quest) }}" class="pixel-btn pixel-btn-purple pixel-btn-sm" style="font-size: 7px; padding: 4px 10px;">
                                                        ✚ ADD QUIZ
                                                    </a>
                                                @else
                                                    <span class="font-pixel text-[7px] text-pixel-text-muted">📝 ADD MATERIAL FIRST</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>
@endsection
