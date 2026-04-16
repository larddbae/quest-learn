@extends('layouts.admin')

@section('title', 'Game Master Dashboard')

@section('main')
{{-- ============================================
     STAT CARDS ROW
     ============================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <x-stat-card
        label="TOTAL<br/>STUDENTS"
        :value="$totalStudents"
        icon="groups"
        color="blue"
    />
    <x-stat-card
        label="ACTIVE<br/>GUILDS"
        :value="$totalClassrooms"
        icon="swords"
        color="gold"
    />
    <x-stat-card
        label="AVG.<br/>LEVEL"
        :value="$totalStudents > 0 ? number_format($classrooms->flatMap->students->avg('level') ?? 0, 1) : '0'"
        icon="military_tech"
        color="green"
    />
    <x-stat-card
        label="BADGES<br/>AWARDED"
        :value="$totalStudents > 0 ? $classrooms->flatMap->students->sum(fn($s) => $s->badges->count()) : 0"
        icon="workspace_premium"
        color="gold"
    />
</div>

{{-- ============================================
     MAIN CONTENT: Guild Monitor + Activity Logs
     ============================================ --}}
<div class="grid grid-cols-12 gap-6">
    {{-- LEFT: Live Student Monitor --}}
    <section class="col-span-12 xl:col-span-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h2 class="font-headline text-sm text-on-surface uppercase">LIVE STUDENT MONITOR</h2>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-secondary-container animate-pulse"></span>
                <span class="font-headline text-[0.55rem] text-secondary-container uppercase">STATUS: REAL-TIME UPDATES ENABLED</span>
            </div>
        </div>

        {{-- Guild Cards --}}
        @forelse($classrooms as $classroom)
            <x-pixel-card variant="low" padding="md" class="mb-6">
                {{-- Guild Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-4 border-b-2 border-outline-variant">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary-container text-xl" style="font-variation-settings: 'FILL' 1;">fort</span>
                        <div>
                            <h3 class="font-headline text-[0.7rem] text-on-surface uppercase">{{ $classroom->name }}</h3>
                            <p class="font-body text-base text-on-surface-variant">
                                {{ $classroom->students_count }} {{ Str::plural('player', $classroom->students_count) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        {{-- Join Code Badge --}}
                        <div class="bg-surface-container border-2 border-black px-3 py-1">
                            <span class="font-headline text-[8px] text-on-surface-variant">CODE: </span>
                            <span class="font-headline text-[9px] text-primary-container tracking-widest">{{ $classroom->join_code }}</span>
                        </div>
                        {{-- Action Buttons --}}
                        <x-pixel-button variant="blue" size="sm" href="{{ route('admin.classrooms.show', $classroom) }}">
                            [ VIEW STATS ]
                        </x-pixel-button>
                        <x-pixel-button variant="green" size="sm" href="{{ route('admin.subjects.index', $classroom) }}">
                            [ SUBJECTS ]
                        </x-pixel-button>
                    </div>
                </div>

                {{-- Student Grid --}}
                @if($classroom->students_count > 0 && $classroom->students)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($classroom->students->take(6) as $student)
                            <div class="bg-surface-container border-2 border-black p-3 flex items-center gap-3">
                                {{-- Student Avatar --}}
                                <div class="w-10 h-10 border-2 border-black bg-surface-container-high flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-tertiary-fixed text-xl" style="font-variation-settings: 'FILL' 1;">person</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-body text-base text-on-surface truncate">{{ $student->name }}</p>
                                    <p class="font-headline text-[7px] text-on-surface-variant">Rank: {{ $student->rank }}</p>
                                </div>
                                {{-- Level Badge --}}
                                <div class="bg-secondary-container text-on-secondary-container px-2 py-0.5 border-2 border-black">
                                    <span class="font-headline text-[8px]">LVL {{ $student->level }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($classroom->students_count > 6)
                        <div class="mt-3 text-center">
                            <a href="{{ route('admin.classrooms.show', $classroom) }}" class="font-headline text-[0.55rem] text-[#3a86ff] hover:text-primary-container transition-colors">
                                + {{ $classroom->students_count - 6 }} more players →
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-6">
                        <span class="material-symbols-outlined text-surface-variant text-4xl">person_off</span>
                        <p class="font-body text-base text-on-surface-variant mt-2">No players have joined yet.</p>
                    </div>
                @endif
            </x-pixel-card>
        @empty
            {{-- Empty State --}}
            <x-pixel-card variant="low" padding="lg">
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-surface-variant text-7xl mb-4">fort</span>
                    <p class="font-headline text-[10px] text-on-surface-variant mb-6">No guilds created yet. Build your first guild!</p>
                    <x-pixel-button variant="gold" href="{{ route('admin.classrooms.create') }}" icon="add">
                        CREATE YOUR FIRST GUILD
                    </x-pixel-button>
                </div>
            </x-pixel-card>
        @endforelse

        {{-- Create New Guild Button --}}
        @if($classrooms->count() > 0)
            <div class="mt-6">
                <x-pixel-button variant="gold" :full="true" href="{{ route('admin.classrooms.create') }}" icon="add">
                    CREATE NEW GUILD
                </x-pixel-button>
            </div>
        @endif
    </section>

    {{-- RIGHT: Activity Logs Panel --}}
    <aside class="col-span-12 xl:col-span-4 flex flex-col gap-6">
        {{-- Activity Header --}}
        <x-pixel-card variant="high" padding="md">
            <h2 class="font-headline text-[0.7rem] text-primary-container uppercase text-center">ACTIVITY LOGS</h2>
        </x-pixel-card>

        {{-- Activity Log Entries --}}
        <div class="space-y-3 custom-scrollbar max-h-[600px] overflow-y-auto pr-1">
            {{-- Per-classroom activity --}}
            @foreach($classrooms->take(3) as $classroom)
                {{-- Students enrolled activity --}}
                @if($classroom->students_count > 0)
                    <x-pixel-card variant="low" padding="sm">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary-container text-lg mt-0.5">trending_up</span>
                            <div class="min-w-0">
                                <p class="font-headline text-[0.55rem] text-secondary-container uppercase">GUILD UPDATE</p>
                                <p class="font-body text-base text-on-surface-variant">
                                    <span class="text-primary-container">{{ $classroom->name }}</span> has {{ $classroom->students_count }} active {{ Str::plural('player', $classroom->students_count) }}
                                </p>
                                <p class="font-body text-sm text-surface-variant uppercase mt-1">GUILD {{ strtoupper($classroom->name) }}</p>
                            </div>
                        </div>
                    </x-pixel-card>
                @endif
            @endforeach

            {{-- System Activity --}}
            <x-pixel-card variant="low" padding="sm">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary-container text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">shield</span>
                    <div>
                        <p class="font-headline text-[0.55rem] text-primary-container uppercase">SYSTEM</p>
                        <p class="font-body text-base text-on-surface-variant">GM Dashboard initialized</p>
                        <p class="font-body text-sm text-surface-variant uppercase mt-1">GM SYSTEM</p>
                    </div>
                </div>
            </x-pixel-card>

            <x-pixel-card variant="low" padding="sm">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary-container text-lg mt-0.5">login</span>
                    <div>
                        <p class="font-headline text-[0.55rem] text-secondary-container uppercase">LOGGED</p>
                        <p class="font-body text-base text-on-surface-variant">Session active</p>
                        <p class="font-body text-sm text-surface-variant uppercase mt-1">GM SYSTEM</p>
                    </div>
                </div>
            </x-pixel-card>
        </div>

        {{-- Export Button --}}
        <x-pixel-card variant="low" padding="md">
            <x-pixel-button variant="gold" :full="true" size="sm">
                EXPORT LOGS
            </x-pixel-button>
        </x-pixel-card>
    </aside>
</div>
@endsection
