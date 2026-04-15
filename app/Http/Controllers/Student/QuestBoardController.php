<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Subject;
use App\Models\UserProgress;

class QuestBoardController extends Controller
{
    /**
     * Quest Board — shows ALL quests across all subjects in the student's classroom,
     * organized by subject with unlock/completion status.
     */
    public function index()
    {
        $user = auth()->user();

        $subjects = Subject::where('classroom_id', $user->classroom_id)
            ->with(['quests' => function ($q) {
                $q->orderBy('order');
            }])
            ->get();

        // Attach unlock & progress status to each quest
        foreach ($subjects as $subject) {
            foreach ($subject->quests as $quest) {
                $quest->is_unlocked = $quest->isUnlockedFor($user);
                $quest->progress = UserProgress::where('user_id', $user->id)
                    ->where('quest_id', $quest->id)
                    ->first();
            }
        }

        $completedCount = UserProgress::where('user_id', $user->id)->where('is_completed', true)->count();
        $totalCount = $subjects->sum(fn($s) => $s->quests->count());

        return view('student.quest-board', compact('subjects', 'completedCount', 'totalCount'));
    }
}
