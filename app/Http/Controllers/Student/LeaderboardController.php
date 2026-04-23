<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeClassroomId = session('active_classroom_id');

        // Get all student user IDs enrolled in the active classroom via pivot
        $leaderboard = User::whereHas('classrooms', function ($q) use ($activeClassroomId) {
                $q->where('classrooms.id', $activeClassroomId);
            })
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
