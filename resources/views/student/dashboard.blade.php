@extends('layouts.student')

@section('title', 'Player Dashboard')

@section('main')
<div class="grid grid-cols-12 gap-6">
    {{-- ============================================
         LEFT PANEL: Character HUD
         ============================================ --}}
    <aside class="col-span-12 lg:col-span-3 flex flex-col gap-6">
        {{-- Character Card --}}
        <x-pixel-card variant="low" padding="lg">
            <div class="flex flex-col items-center gap-4">
                {{-- Avatar Frame --}}
                <div class="w-40 h-40 border-4 border-black bg-surface-container-lowest p-1 pixel-shadow">
                    <div class="w-full h-full flex items-center justify-center text-7xl animate-float pixel-image bg-surface-container overflow-hidden">
                        @if($user->avatar && !in_array($user->avatar, ['🧙', '🧝', '🧛', '🧜']))
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover pixel-image">
                        @else
                            <span class="material-symbols-outlined text-primary-container text-8xl" style="font-variation-settings: 'FILL' 1;">person</span>
                        @endif
                    </div>
                </div>

                {{-- Name & Level --}}
                <div class="text-center">
                    <h1 class="font-headline text-sm text-on-surface uppercase">{{ $user->name }}</h1>
                    <p class="font-headline text-xs text-primary-container mt-1">LVL {{ $user->level }}</p>
                </div>

                {{-- XP Progress Bar --}}
                <div class="w-full">
                    <x-xp-bar
                        :current="$user->xp"
                        :max="$user->xpForNextLevel()"
                        :segments="12"
                        label="XP_PROGRESS"
                        color="green"
                        height="sm"
                    />
                </div>

                {{-- Quick Stats Grid --}}
                <div class="w-full space-y-2 mt-2">
                    <div class="bg-surface-container border-2 border-black px-4 py-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary-container text-xl">swords</span>
                        <span class="font-body text-lg">Quests: {{ $completedQuests }}</span>
                    </div>
                    <div class="bg-surface-container border-2 border-black px-4 py-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-tertiary-fixed-dim text-xl" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                        <span class="font-body text-lg">Badges: {{ $user->badges->count() }}</span>
                    </div>
                    <div class="bg-surface-container border-2 border-black px-4 py-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">school</span>
                        <span class="font-body text-lg">Guild: {{ $activeClassroom->name ?? 'None' }}</span>
                    </div>
                </div>
            </div>
        </x-pixel-card>

        {{-- Start Adventure Button --}}
        <x-pixel-button variant="gold" :full="true" href="{{ route('student.subjects.index') }}" icon="explore">
            START_ADVENTURE
        </x-pixel-button>
    </aside>

    {{-- ============================================
         CENTER PANEL: Active Quests / Recent Quests
         ============================================ --}}
    <section class="col-span-12 lg:col-span-6 flex flex-col gap-6">
        {{-- Section Header --}}
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">bolt</span>
            <h2 class="font-headline text-sm text-on-surface uppercase">ACTIVE QUESTS</h2>
        </div>

        {{-- Quest Cards --}}
        @forelse($recentProgress as $progress)
            @php
                $subjectName = strtolower($progress->quest->subject->name ?? '');
                $questIcon = match(true) {
                    str_contains($subjectName, 'science') => 'science',
                    str_contains($subjectName, 'math') => 'calculate',
                    str_contains($subjectName, 'history') => 'history_edu',
                    str_contains($subjectName, 'english') => 'local_library',
                    default => 'trophy',
                };
            @endphp
            <x-pixel-card variant="low" padding="md" hover>
                <div class="flex gap-4">
                    {{-- Quest Icon --}}
                    <div class="w-14 h-14 flex-shrink-0 border-4 border-black bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">
                            {{ $questIcon }}
                        </span>
                    </div>

                    {{-- Quest Info --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-headline text-[0.7rem] text-primary-container uppercase mb-1 truncate">
                            {{ $progress->quest->title }}
                        </h3>
                        <p class="font-body text-lg text-on-surface-variant leading-tight mb-3">
                            {{ $progress->quest->subject->name ?? '' }} • Score: {{ $progress->score }}/{{ $progress->total_questions }}
                        </p>

                        {{-- Progress Bar --}}
                        <div class="mb-2">
                            <x-xp-bar
                                :current="$progress->score"
                                :max="$progress->total_questions"
                                :segments="$progress->total_questions > 0 ? min($progress->total_questions, 10) : 10"
                                :showValues="false"
                                color="green"
                                height="sm"
                            />
                        </div>

                        {{-- Footer: Percentage + XP Reward --}}
                        <div class="flex justify-between items-center">
                            <span class="font-headline text-[0.6rem] text-secondary-container">
                                {{ $progress->total_questions > 0 ? round(($progress->score / $progress->total_questions) * 100) : 0 }}%_COMPLETE
                            </span>
                            <span class="font-headline text-[0.55rem] text-primary-container">
                                +{{ $progress->quest->xp_reward }}XP
                            </span>
                        </div>
                    </div>
                </div>
            </x-pixel-card>
        @empty
            <x-pixel-card variant="low" padding="lg">
                <div class="text-center py-8">
                    <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">explore</span>
                    <p class="font-headline text-[10px] text-on-surface-variant mb-4">No quests completed yet.</p>
                    <x-pixel-button variant="gold" size="sm" href="{{ route('student.subjects.index') }}" icon="play_arrow">
                        START QUESTING
                    </x-pixel-button>
                </div>
            </x-pixel-card>
        @endforelse

        {{-- Subject Levels Section --}}
        <div class="mt-2">
            <h2 class="font-headline text-[0.7rem] text-primary-container uppercase mb-4">SUBJECT_LEVELS</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @php
                    $subjectIcons = [
                        'science' => 'science',
                        'math' => 'calculate',
                        'history' => 'history_edu',
                        'english' => 'local_library',
                    ];
                @endphp
                @if($activeClassroom)
                    @foreach($activeClassroom->subjects ?? [] as $subject)
                        <x-pixel-card variant="high" padding="md" hover>
                            <div class="flex flex-col items-center text-center gap-2">
                                <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">
                                    {{ $subjectIcons[strtolower($subject->name)] ?? 'menu_book' }}
                                </span>
                                <span class="font-headline text-[0.55rem] text-on-surface uppercase">{{ Str::limit($subject->name, 10) }}</span>
                            </div>
                        </x-pixel-card>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ============================================
         RIGHT PANEL: Recent Activity Log
         ============================================ --}}
    <aside class="col-span-12 lg:col-span-3 flex flex-col gap-6">
        {{-- Activity Header --}}
        <x-pixel-card variant="high" padding="md">
            <h2 class="font-headline text-[0.7rem] text-primary-container uppercase text-center">RECENT_ACTIVITY</h2>
        </x-pixel-card>

        {{-- Activity Log Items --}}
        <div class="space-y-3">
            {{-- Recent Quests as Activity Items --}}
            @foreach($recentProgress->take(3) as $progress)
                <x-pixel-card variant="low" padding="sm">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <div class="min-w-0">
                            <p class="font-headline text-[0.55rem] text-secondary-container uppercase">COMPLETED</p>
                            <p class="font-body text-base text-on-surface-variant truncate">Quest: {{ $progress->quest->title }}</p>
                        </div>
                    </div>
                </x-pixel-card>
            @endforeach

            {{-- Recent Badges as Activity Items --}}
            @foreach($recentBadges as $badge)
                <x-pixel-card variant="low" padding="sm">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary-container text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                        <div class="min-w-0">
                            <p class="font-headline text-[0.55rem] text-primary-container uppercase">BADGE EARNED</p>
                            <p class="font-body text-base text-on-surface-variant truncate">{{ $badge->name }}</p>
                        </div>
                    </div>
                </x-pixel-card>
            @endforeach

            {{-- Level Up Activity --}}
            @if($user->level > 1)
                <x-pixel-card variant="low" padding="sm">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#3a86ff] text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                        <div>
                            <p class="font-headline text-[0.55rem] text-[#3a86ff] uppercase">LVL UP</p>
                            <p class="font-body text-base text-on-surface-variant">Reached LVL {{ $user->level }}</p>
                        </div>
                    </div>
                </x-pixel-card>
            @endif

            {{-- Guild Activity --}}
            @if($activeClassroom)
                <x-pixel-card variant="low" padding="sm">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">groups</span>
                        <div>
                            <p class="font-headline text-[0.55rem] text-secondary-container uppercase">GUILD JOINED</p>
                            <p class="font-body text-base text-on-surface-variant">{{ $activeClassroom->name }}</p>
                        </div>
                    </div>
                </x-pixel-card>
            @endif
        </div>

        {{-- View All Logs Button --}}
        <x-pixel-button variant="ghost" :full="true" size="sm" href="{{ route('student.profile') }}">
            VIEW_ALL_LOGS
        </x-pixel-button>
    </aside>
</div>
@endsection
