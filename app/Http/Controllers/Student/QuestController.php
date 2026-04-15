<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Subject;
use App\Models\UserProgress;

class QuestController extends Controller
{
    public function index(Subject $subject)
    {
        $user = auth()->user();

        // Verify subject belongs to user's classroom
        if ($subject->classroom_id !== $user->classroom_id) {
            abort(403);
        }

        $quests = $subject->quests()->orderBy('order')->get();

        // Attach unlock status and completion for each quest
        $quests->each(function ($quest) use ($user) {
            $quest->is_unlocked = $quest->isUnlockedFor($user);
            $quest->progress = UserProgress::where('user_id', $user->id)
                ->where('quest_id', $quest->id)
                ->first();
        });

        return view('student.quests.index', compact('subject', 'quests'));
    }
}
