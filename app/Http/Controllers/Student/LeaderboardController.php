<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $leaderboard = User::where('classroom_id', $user->classroom_id)
            ->where('role', 'student')
            ->orderByRaw("FIELD(rank, 'Diamond', 'Platinum', 'Gold', 'Silver', 'Bronze')")
            ->orderBy('level', 'desc')
            ->orderBy('xp', 'desc')
            ->get();

        $userRank = $leaderboard->search(function ($item) use ($user) {
            return $item->id === $user->id;
        });

        return view('student.leaderboard', compact('leaderboard', 'user', 'userRank'));
    }
}
