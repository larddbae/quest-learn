@extends('layouts.student')

@section('title', 'Guild Leaderboard')

@section('main')
<div class="max-w-5xl mx-auto pb-12">
    {{-- Arcade Header --}}
    <div class="text-center mb-12">
        <span class="material-symbols-outlined text-primary-container text-6xl mb-4 animate-bounce" style="font-variation-settings: 'FILL' 1;">trophy</span>
        <h1 class="font-headline text-3xl text-primary-container pixel-glow mb-2 uppercase tracking-widest">
            HIGH SCORES
        </h1>
        <div class="inline-block bg-background border-2 border-primary-container px-6 py-2 mt-2">
            <p class="font-headline text-[0.7rem] text-secondary-container uppercase tracking-wider">
                {{ $user->activeClassroom()->name ?? 'SYSTEM GUILD' }}
            </p>
        </div>
    </div>

    @if($leaderboard->isEmpty())
        <x-pixel-card variant="low" padding="xl" class="text-center">
            <span class="material-symbols-outlined text-surface-variant text-6xl mb-4">videogame_asset_off</span>
            <p class="font-headline text-[0.8rem] text-surface-variant uppercase tracking-widest mt-2">INSERT COIN TO BEGIN</p>
            <p class="font-body text-lg text-on-surface-variant mt-4">No players have joined this guild's leaderboard yet.</p>
        </x-pixel-card>
    @else
        {{-- ============================================
             THE PODIUM (TOP 3)
             ============================================ --}}
        @if($leaderboard->currentPage() === 1 && $leaderboard->count() >= 3)
            <div class="flex flex-col md:flex-row items-end justify-center gap-4 md:gap-6 mb-12 max-w-3xl mx-auto">
                
                {{-- 2ND PLACE (SILVER) --}}
                <div class="w-full md:w-1/3 order-2 md:order-1 flex flex-col items-center">
                    <div class="pixel-box bg-background border-4 border-slate-300 p-4 text-center w-full min-h-[160px] flex flex-col justify-end shadow-[4px_4px_0_0_#94a3b8]">
                        <span class="material-symbols-outlined text-slate-300 text-4xl mb-2" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                        <div class="text-4xl mb-3 z-10">{{ $leaderboard[1]->avatar ?? '🧙' }}</div>
                        <p class="font-headline text-[0.6rem] text-slate-200 truncate uppercase w-full">{{ $leaderboard[1]->name }}</p>
                        <p class="font-body text-lg text-slate-400 mt-1">{{ number_format($leaderboard[1]->xp) }} XP</p>
                        <p class="font-headline text-[0.5rem] bg-slate-200 text-slate-900 border-2 border-slate-400 inline-block px-1 mt-2">LVL {{ $leaderboard[1]->level }}</p>
                    </div>
                    <div class="w-3/4 h-8 bg-slate-300 border-x-4 border-b-4 border-black"></div>
                </div>

                {{-- 1ST PLACE (GOLD) --}}
                <div class="w-full md:w-1/3 order-1 md:order-2 flex flex-col items-center animate-pulse-slow">
                    <div class="pixel-box bg-background border-4 border-[#ffd700] p-6 text-center w-full min-h-[200px] flex flex-col justify-end shadow-[4px_4px_0_0_#ca8a04] pixel-glow relative">
                        <span class="material-symbols-outlined text-[#ffd700] text-6xl absolute -top-8 left-1/2 -translate-x-1/2 drop-shadow-[2px_2px_0_#000]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        <div class="text-5xl mb-4 z-10 animate-float mt-4">{{ $leaderboard[0]->avatar ?? '🧙' }}</div>
                        <p class="font-headline text-[0.75rem] text-[#ffd700] truncate uppercase w-full">{{ $leaderboard[0]->name }}</p>
                        <p class="font-body text-xl text-yellow-500 mt-1">{{ number_format($leaderboard[0]->xp) }} XP</p>
                        <p class="font-headline text-[0.55rem] bg-[#ffd700] text-yellow-900 border-2 border-yellow-600 inline-block px-2 mt-2">LVL {{ $leaderboard[0]->level }}</p>
                    </div>
                    <div class="w-3/4 h-16 bg-[#ffd700] border-x-4 border-b-4 border-black shadow-[4px_4px_0_0_#ca8a04]"></div>
                </div>

                {{-- 3RD PLACE (BRONZE) --}}
                <div class="w-full md:w-1/3 order-3 md:order-3 flex flex-col items-center">
                    <div class="pixel-box bg-background border-4 border-[#b87333] p-4 text-center w-full min-h-[140px] flex flex-col justify-end shadow-[4px_4px_0_0_#78350f]">
                        <span class="material-symbols-outlined text-[#b87333] text-4xl mb-2" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                        <div class="text-3xl mb-3 z-10">{{ $leaderboard[2]->avatar ?? '🧙' }}</div>
                        <p class="font-headline text-[0.6rem] text-orange-200 truncate uppercase w-full">{{ $leaderboard[2]->name }}</p>
                        <p class="font-body text-lg text-orange-300 mt-1">{{ number_format($leaderboard[2]->xp) }} XP</p>
                        <p class="font-headline text-[0.5rem] bg-[#b87333] text-orange-900 border-2 border-orange-700 inline-block px-1 mt-2">LVL {{ $leaderboard[2]->level }}</p>
                    </div>
                    <div class="w-3/4 h-6 bg-[#b87333] border-x-4 border-b-4 border-black"></div>
                </div>
                
            </div>
        @endif

        {{-- ============================================
             HIGH SCORE TABLE (REST OF PLAYERS + ALL PLAYERS IF < 3)
             ============================================ --}}
        <x-pixel-card variant="low" padding="sm" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b-4 border-black">
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase w-16 text-center">RANK</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase">PLAYER</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase text-center">LEVEL</th>
                        <th class="p-4 font-headline text-[0.6rem] text-surface-variant uppercase hidden sm:table-cell">CLASS</th>
                        <th class="p-4 font-headline text-[0.6rem] text-primary-container uppercase text-right">SCORE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaderboard as $index => $player)
                        @php
                            $isCurrentUser = $player->id === $user->id;
                            $rowClass = $isCurrentUser 
                                ? 'bg-primary-container text-black border-y-4 border-black font-bold transform scale-[1.01] shadow-[0_4px_0_0_rgba(0,0,0,1)]' 
                                : 'border-b-2 border-surface-container hover:bg-surface-container transition-colors text-on-surface';
                            $textColor = $isCurrentUser ? 'text-black' : 'text-on-surface';
                            $mutedColor = $isCurrentUser ? 'text-slate-800' : 'text-on-surface-variant';
                        @endphp
                        <tr class="{{ $rowClass }} h-16">
                            {{-- Rank # --}}
                            <td class="p-4 text-center">
                                @php
                                    $overallRank = ($leaderboard->currentPage() - 1) * $leaderboard->perPage() + $index;
                                @endphp
                                @if($overallRank === 0)
                                    <span class="font-headline text-lg {{ $isCurrentUser ? 'text-yellow-100' : 'text-primary-container' }}">1ST</span>
                                @elseif($overallRank === 1)
                                    <span class="font-headline text-lg {{ $isCurrentUser ? 'text-slate-100' : 'text-slate-300' }}">2ND</span>
                                @elseif($overallRank === 2)
                                    <span class="font-headline text-lg {{ $isCurrentUser ? 'text-orange-900' : 'text-[#b87333]' }}">3RD</span>
                                @else
                                    <span class="font-headline text-[0.7rem] {{ $mutedColor }}">{{ $overallRank + 1 }}</span>
                                @endif
                            </td>
                            
                            {{-- Player Name & Avatar --}}
                            <td class="p-4">
                                <a href="{{ route('student.profile.public', $player->id) }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                                    <div class="w-10 h-10 border-2 border-black flex items-center justify-center bg-background shrink-0 select-none {{ $isCurrentUser ? 'shadow-[2px_2px_0_0_rgba(0,0,0,0.5)]' : '' }}">
                                        @if($player->avatar && !in_array($player->avatar, ['🧙', '🧝', '🧛', '🧜', '🗡️', '']))
                                            <img src="{{ asset('storage/' . $player->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-2xl">{{ $player->avatar ?? '🧙' }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-headline text-[0.7rem] uppercase {{ $textColor }} truncate max-w-[120px] sm:max-w-[200px] hover:underline">
                                            {{ $player->name }}
                                        </span>
                                        @if($isCurrentUser)
                                            <span class="font-headline text-[0.45rem] mt-1 bg-black text-white px-1 leading-none uppercase self-start">YOU</span>
                                        @endif
                                    </div>
                                </a>
                            </td>

                            {{-- Level --}}
                            <td class="p-4 text-center">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full border-2 border-black {{ $isCurrentUser ? 'bg-black text-primary-container' : 'bg-surface-container text-on-surface' }}">
                                    <span class="font-headline text-[0.6rem] pt-1">{{ $player->level }}</span>
                                </div>
                            </td>

                            {{-- Rank / Class (Hidden on small mobile) --}}
                            <td class="p-4 hidden sm:table-cell">
                                <span class="font-headline text-[0.55rem] px-2 py-1 border-2 border-black uppercase {{ $isCurrentUser ? 'bg-white text-black' : 'bg-background text-secondary-container' }}">
                                    {{ $player->rank }}
                                </span>
                            </td>

                            {{-- XP / Score --}}
                            <td class="p-4 text-right">
                                <span class="font-headline text-[0.75rem] tracking-wider {{ $isCurrentUser ? 'text-black' : 'text-primary-container' }}">
                                    {{ number_format($player->xp) }} <span class="text-[0.5rem] {{ $mutedColor }}">XP</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-pixel-card>

        <div class="mt-8">
            {{ $leaderboard->links() }}
        </div>
    @endif
</div>
@endsection
