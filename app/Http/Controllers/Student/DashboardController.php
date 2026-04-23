<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeClassroom = $user->activeClassroom();

        $user->load(['badges', 'progress']);

        $completedQuests = $user->progress()->where('is_completed', true)->count();
        $totalXP = UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->join('quests', 'user_progress.quest_id', '=', 'quests.id')
            ->sum('quests.xp_reward');

        $recentProgress = $user->progress()
            ->with('quest.subject')
            ->where('is_completed', true)
            ->orderBy('completed_at', 'desc')
            ->take(5)
            ->get();

        $recentBadges = $user->badges()
            ->orderByPivot('awarded_at', 'desc')
            ->take(3)
            ->get();

        return view('student.dashboard', compact(
            'user', 'activeClassroom', 'completedQuests',
            'totalXP', 'recentProgress', 'recentBadges'
        ));
    }
}
