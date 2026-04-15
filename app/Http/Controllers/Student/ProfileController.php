<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load(['badges', 'bookmarks.material.quest.subject']);

        $completedQuests = $user->progress()->where('is_completed', true)->count();
        $totalXP = UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->join('quests', 'user_progress.quest_id', '=', 'quests.id')
            ->sum('quests.xp_reward');

        $perfectScores = $user->progress()
            ->where('is_completed', true)
            ->whereColumn('score', 'total_questions')
            ->count();

        $bookmarks = $user->bookmarks()->with('material.quest.subject')->get();
        $badges = $user->badges()->orderByPivot('awarded_at', 'desc')->get();

        return view('student.profile', compact('user', 'completedQuests', 'totalXP', 'perfectScores', 'bookmarks', 'badges'));
    }
}
