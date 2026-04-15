<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;

class QuizArenaController extends Controller
{
    /**
     * Quiz Arena hub — shows available quizzes (unlocked, not yet taken)
     * and completed quiz history with scores.
     */
    public function index()
    {
        $user = auth()->user();

        // Available quizzes: unlocked quests that have quizzes and haven't been completed
        $availableQuests = \App\Models\Quest::whereHas('subject', function ($q) use ($user) {
            $q->where('classroom_id', $user->classroom_id);
        })
        ->whereHas('material.quizzes')
        ->whereDoesntHave('userProgress', function ($q) use ($user) {
            $q->where('user_id', $user->id)->where('is_completed', true);
        })
        ->with(['material.quizzes', 'subject'])
        ->get()
        ->filter(function ($quest) use ($user) {
            return $quest->isUnlockedFor($user);
        });

        // Completed quizzes with scores
        $completedProgress = UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->with(['quest.subject', 'quest.material'])
            ->orderBy('completed_at', 'desc')
            ->get();

        $totalScore = $completedProgress->sum('score');
        $totalQuestions = $completedProgress->sum('total_questions');
        $perfectCount = $completedProgress->filter(fn($p) => $p->score === $p->total_questions)->count();

        return view('student.quiz-arena', compact(
            'availableQuests', 'completedProgress',
            'totalScore', 'totalQuestions', 'perfectCount'
        ));
    }
}
