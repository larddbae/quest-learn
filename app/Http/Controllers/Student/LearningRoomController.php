<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Material;
use App\Models\UserProgress;

class LearningRoomController extends Controller
{
    /**
     * Learning Room — shows student's available/in-progress materials,
     * bookmarks, and recently accessed content.
     */
    public function index()
    {
        $user = auth()->user();

        // Get all quests the user has unlocked but not completed (in-progress materials)
        $inProgressQuests = \App\Models\Quest::whereHas('subject', function ($q) use ($user) {
            $q->where('classroom_id', $user->classroom_id);
        })
        ->whereDoesntHave('userProgress', function ($q) use ($user) {
            $q->where('user_id', $user->id)->where('is_completed', true);
        })
        ->with(['material', 'subject'])
        ->get()
        ->filter(function ($quest) use ($user) {
            return $quest->isUnlockedFor($user) && $quest->material;
        });

        // Completed quest materials (for review)
        $completedQuests = \App\Models\Quest::whereHas('subject', function ($q) use ($user) {
            $q->where('classroom_id', $user->classroom_id);
        })
        ->whereHas('userProgress', function ($q) use ($user) {
            $q->where('user_id', $user->id)->where('is_completed', true);
        })
        ->with(['material', 'subject', 'userProgress' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])
        ->get()
        ->filter(fn($quest) => $quest->material);

        // Bookmarked materials
        $bookmarks = Bookmark::where('user_id', $user->id)
            ->with('material.quest.subject')
            ->latest()
            ->get();

        return view('student.learning-room', compact('inProgressQuests', 'completedQuests', 'bookmarks'));
    }
}
