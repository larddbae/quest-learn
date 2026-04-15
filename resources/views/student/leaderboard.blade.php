@extends('layouts.student')

@section('title', 'Guild Leaderboard')

@section('main')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-5xl mb-3">🏆</div>
        <h1 class="font-pixel text-lg text-pixel-gold">GUILD LEADERBOARD</h1>
        <p class="font-pixel-body text-xl text-pixel-text-muted">{{ $user->classroom->name ?? 'Guild' }}</p>
    </div>

    @if($leaderboard->isEmpty())
        <div class="pixel-box p-12 text-center">
            <p class="font-pixel text-[10px] text-pixel-text-muted">No players in this guild yet.</p>
        </div>
    @else
        {{-- Top 3 Podium --}}
        @if($leaderboard->count() >= 3)
            <div class="grid grid-cols-3 gap-4 mb-8 items-end">
                {{-- 2nd Place --}}
                <div class="pixel-box p-4 text-center">
                    <div class="text-4xl mb-2">🥈</div>
                    <div class="text-3xl mb-2">{{ $leaderboard[1]->avatar ?? '🧙' }}</div>
                    <p class="font-pixel text-[8px] text-pixel-text truncate">{{ $leaderboard[1]->name }}</p>
                    <span class="rank-badge rank-{{ strtolower($leaderboard[1]->rank) }} mt-1" style="font-size: 7px;">{{ $leaderboard[1]->rank }}</span>
                    <p class="font-pixel text-[8px] text-pixel-green mt-1">LVL {{ $leaderboard[1]->level }}</p>
                </div>

                {{-- 1st Place --}}
                <div class="pixel-box p-6 text-center animate-glow" style="margin-bottom: 20px;">
                    <div class="text-5xl mb-2">👑</div>
                    <div class="text-4xl mb-2 animate-float">{{ $leaderboard[0]->avatar ?? '🧙' }}</div>
                    <p class="font-pixel text-[9px] text-pixel-gold truncate">{{ $leaderboard[0]->name }}</p>
                    <span class="rank-badge rank-{{ strtolower($leaderboard[0]->rank) }} mt-1" style="font-size: 8px;">{{ $leaderboard[0]->rank }}</span>
                    <p class="font-pixel text-[9px] text-pixel-green mt-1">LVL {{ $leaderboard[0]->level }}</p>
                </div>

                {{-- 3rd Place --}}
                <div class="pixel-box p-4 text-center">
                    <div class="text-4xl mb-2">🥉</div>
                    <div class="text-3xl mb-2">{{ $leaderboard[2]->avatar ?? '🧙' }}</div>
                    <p class="font-pixel text-[8px] text-pixel-text truncate">{{ $leaderboard[2]->name }}</p>
                    <span class="rank-badge rank-{{ strtolower($leaderboard[2]->rank) }} mt-1" style="font-size: 7px;">{{ $leaderboard[2]->rank }}</span>
                    <p class="font-pixel text-[8px] text-pixel-green mt-1">LVL {{ $leaderboard[2]->level }}</p>
                </div>
            </div>
        @endif

        {{-- Full Rankings Table --}}
        <table class="pixel-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Player</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>XP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $player)
                    <tr class="{{ $player->id === $user->id ? 'ring-2 ring-pixel-gold' : '' }}">
                        <td class="font-pixel text-[10px] text-pixel-gold">{{ $index + 1 }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-xl">{{ $player->avatar ?? '🧙' }}</span>
                                <span class="font-pixel-body text-lg {{ $player->id === $user->id ? 'text-pixel-gold' : 'text-pixel-text' }}">
                                    {{ $player->name }}
                                    @if($player->id === $user->id)
                                        <span class="text-pixel-cyan">(YOU)</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="font-pixel text-[10px] text-pixel-green">{{ $player->level }}</td>
                        <td>
                            <span class="rank-badge rank-{{ strtolower($player->rank) }}" style="font-size: 8px;">{{ $player->rank }}</span>
                        </td>
                        <td class="font-pixel text-[10px] text-pixel-cyan">{{ number_format($player->xp) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
