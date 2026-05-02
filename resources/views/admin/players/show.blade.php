@extends('layouts.admin')

@section('title', 'Player Dossier — ' . $student->name)

@section('main')
<div class="max-w-6xl mx-auto pb-12">
    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 font-headline text-[0.6rem] text-surface-variant hover:text-primary-container transition-colors uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            BACK TO GUILD
        </a>
    </div>

    {{-- Section 1: Identity & Core Stats --}}
    <x-pixel-card variant="high" padding="lg" class="mb-8 border-4 border-primary-container relative">
        <div class="absolute -top-4 -right-4 bg-primary-container text-on-primary-container font-headline text-xs px-3 py-1 border-2 border-black rotate-3 shadow-[4px_4px_0_0_#000]">
            CLASSIFIED
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8">
            {{-- Avatar --}}
            <div class="w-32 h-32 border-4 border-black bg-surface-container-high flex items-center justify-center shadow-[6px_6px_0_0_#000] shrink-0">
                @if($student->avatar && strlen($student->avatar) > 10)
                    <img src="{{ asset('storage/' . $student->avatar) }}" alt="{{ $student->name }}" class="w-full h-full object-cover pixel-corners">
                @else
                    <div class="text-6xl">{{ $student->avatar ?? '🧙♂️' }}</div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-grow text-center md:text-left">
                <h1 class="font-headline text-3xl text-on-surface uppercase mb-2">{{ $student->name }}</h1>
                <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-2">
                    <span class="font-headline text-[0.6rem] text-secondary-container rank-badge rank-{{ strtolower($student->rank) }} border-2 border-secondary-container px-3 py-1">
                        RANK: {{ $student->rank }}
                    </span>
                </div>
                @if($student->bio)
                    <p class="font-body text-sm text-on-surface-variant max-w-lg mx-auto md:mx-0">{{ $student->bio }}</p>
                @endif
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-4 shrink-0 w-full md:w-auto">
                <div class="bg-surface-container border-2 border-black p-4 flex flex-col items-center justify-center shadow-[4px_4px_0_0_#000]">
                    <span class="font-headline text-[0.55rem] text-surface-variant uppercase mb-2">CURRENT LEVEL</span>
                    <span class="font-headline text-3xl text-primary-container">{{ $student->level }}</span>
                </div>
                <div class="bg-surface-container border-2 border-black p-4 flex flex-col items-center justify-center shadow-[4px_4px_0_0_#000]">
                    <span class="font-headline text-[0.55rem] text-surface-variant uppercase mb-2">TOTAL XP</span>
                    <span class="font-headline text-3xl text-secondary-container">{{ number_format($student->xp) }}</span>
                </div>
            </div>
        </div>
    </x-pixel-card>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Column (Combat Log & Quest History) --}}
        <div class="lg:col-span-2 flex flex-col gap-8">
            
            {{-- Section 2: Combat Log (Quizzes) --}}
            <x-pixel-card variant="low" padding="md">
                <div class="flex items-center gap-3 mb-4 border-b-2 border-surface-container pb-2">
                    <span class="material-symbols-outlined text-error text-2xl">shield</span>
                    <h2 class="font-headline text-lg text-on-surface uppercase">COMBAT LOG</h2>
                </div>
                
                @if($userProgress->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-2">history</span>
                        <p class="font-headline text-xs uppercase tracking-wider">NO COMBAT RECORDS DETECTED</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[500px]">
                            <thead>
                                <tr class="border-b-2 border-black bg-surface-container">
                                    <th class="p-3 font-headline text-[0.6rem] text-surface-variant uppercase tracking-wider">Date</th>
                                    <th class="p-3 font-headline text-[0.6rem] text-surface-variant uppercase tracking-wider">Target (Quest)</th>
                                    <th class="p-3 font-headline text-[0.6rem] text-surface-variant uppercase tracking-wider">Subject</th>
                                    <th class="p-3 font-headline text-[0.6rem] text-surface-variant uppercase tracking-wider text-right">Outcome</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userProgress as $progress)
                                    @php
                                        $total = $progress->total_questions ?? 0;
                                        $score = $progress->score ?? 0;
                                        $percentage = $total > 0 ? ($score / $total) * 100 : 0;
                                        $passed = $percentage >= 70;
                                    @endphp
                                    <tr class="border-b border-surface-container hover:bg-surface-container-high transition-colors">
                                        <td class="p-3 font-body text-xs text-on-surface-variant whitespace-nowrap">
                                            {{ $progress->updated_at->format('M d, Y') }}
                                        </td>
                                        <td class="p-3">
                                            <span class="font-headline text-sm text-primary-container truncate max-w-[200px] block" title="{{ $progress->quest->title ?? 'Unknown' }}">
                                                {{ $progress->quest->title ?? 'Unknown' }}
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <span class="font-headline text-[0.55rem] text-secondary-container border border-secondary-container px-2 py-0.5 whitespace-nowrap bg-secondary-container/10">
                                                {{ $progress->quest->subject->title ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="p-3 text-right">
                                            @if($progress->is_completed)
                                                <div class="flex flex-col items-end">
                                                    <span class="font-headline text-sm {{ $passed ? 'text-green-500' : 'text-error' }}">
                                                        {{ $score }} / {{ $total }}
                                                    </span>
                                                    <span class="font-headline text-[0.5rem] {{ $passed ? 'text-green-500/70' : 'text-error/70' }} tracking-widest mt-0.5">
                                                        {{ $passed ? 'VICTORY' : 'DEFEAT' }}
                                                    </span>
                                                </div>
                                            @else
                                                <span class="font-headline text-[0.6rem] text-warning bg-warning/10 px-2 py-1 border border-warning">IN PROGRESS</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </x-pixel-card>

            {{-- Section 3: Quest History --}}
            <x-pixel-card variant="low" padding="md">
                <div class="flex items-center gap-3 mb-4 border-b-2 border-surface-container pb-2">
                    <span class="material-symbols-outlined text-secondary-container text-2xl">history_edu</span>
                    <h2 class="font-headline text-lg text-on-surface uppercase">QUEST TIMELINE</h2>
                </div>

                @if($completedQuests->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-2">hourglass_empty</span>
                        <p class="font-headline text-xs uppercase tracking-wider">TIMELINE IS EMPTY</p>
                    </div>
                @else
                    <div class="relative border-l-2 border-surface-container ml-3 space-y-6 py-2">
                        @foreach($completedQuests as $questLog)
                            <div class="relative pl-6">
                                {{-- Timeline Node --}}
                                <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full border-2 border-black bg-secondary-container shadow-[2px_2px_0_0_#000]"></div>
                                
                                <div class="bg-surface-container border-2 border-black p-3 shadow-[2px_2px_0_0_#000]">
                                    <span class="font-headline text-[0.55rem] text-surface-variant tracking-wider">
                                        {{ $questLog->completed_at ? $questLog->completed_at->format('M d, Y - H:i') : $questLog->updated_at->format('M d, Y - H:i') }}
                                    </span>
                                    <h4 class="font-headline text-sm text-on-surface mt-1">{{ $questLog->quest->title ?? 'Unknown Quest' }}</h4>
                                    @if(isset($questLog->quest->description))
                                        <p class="font-body text-xs text-on-surface-variant mt-2 line-clamp-2">{{ Str::limit($questLog->quest->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-pixel-card>
            
        </div>

        {{-- Sidebar (Artifacts & Badges) --}}
        <div>
            {{-- Section 4: Earned Artifacts (Badges) --}}
            <x-pixel-card variant="low" padding="md" class="h-full">
                <div class="flex items-center gap-3 mb-6 border-b-2 border-surface-container pb-2">
                    <span class="material-symbols-outlined text-warning text-2xl">workspace_premium</span>
                    <h2 class="font-headline text-lg text-on-surface uppercase">ARTIFACTS</h2>
                </div>

                @if($student->badges->isEmpty())
                    <div class="text-center py-8 border-2 border-dashed border-surface-container">
                        <span class="material-symbols-outlined text-4xl text-surface-variant mb-2">lock</span>
                        <p class="font-headline text-xs text-surface-variant uppercase tracking-wider">NO ARTIFACTS<br>ACQUIRED</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($student->badges as $badge)
                            <div class="flex flex-col items-center p-3 border-2 border-black bg-surface-container shadow-[2px_2px_0_0_#000] group relative cursor-help hover:-translate-y-1 transition-transform">
                                <span class="text-4xl mb-2 group-hover:scale-110 transition-transform drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">{{ $badge->icon }}</span>
                                <h4 class="font-headline text-[0.55rem] text-center text-primary-container leading-tight uppercase tracking-wide">{{ $badge->name }}</h4>
                                
                                {{-- Tooltip (Hidden by default, shown on hover) --}}
                                <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-40 bg-on-surface text-surface border-2 border-black p-2 hidden group-hover:block z-10 shadow-[4px_4px_0_0_rgba(0,0,0,0.5)] pointer-events-none">
                                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-3 h-3 bg-on-surface border-t-2 border-l-2 border-black rotate-45"></div>
                                    <p class="font-body text-[0.6rem] text-center relative z-10">{{ $badge->description }}</p>
                                    @if($badge->pivot && $badge->pivot->awarded_at)
                                        <div class="mt-2 pt-1 border-t border-surface-variant/50 relative z-10">
                                            <p class="font-headline text-[0.45rem] text-primary text-center tracking-wider">UNLOCKED: {{ \Carbon\Carbon::parse($badge->pivot->awarded_at)->format('M d, Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-pixel-card>
        </div>
    </div>
</div>
@endsection
