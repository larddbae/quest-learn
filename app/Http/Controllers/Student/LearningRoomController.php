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
    public function index(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        $activeClassroomId = session('active_classroom_id');
        $subjectId = $request->input('subject_id');

        // Fetch subjects that have materials in this classroom
        $availableSubjects = \App\Models\Subject::where('classroom_id', $activeClassroomId)
            ->whereHas('quests.material')
            ->get();

        // Get all quests the user has unlocked but not completed (in-progress materials)
        $inProgressQuests = \App\Models\Quest::whereHas('subject', function ($q) use ($activeClassroomId, $subjectId) {
            $q->where('classroom_id', $activeClassroomId);
            if ($subjectId) {
                $q->where('id', $subjectId);
            }
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
        $completedQuests = \App\Models\Quest::whereHas('subject', function ($q) use ($activeClassroomId, $subjectId) {
            $q->where('classroom_id', $activeClassroomId);
            if ($subjectId) {
                $q->where('id', $subjectId);
            }
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
        $bookmarksQuery = Bookmark::where('user_id', $user->id)
            ->whereHas('material.quest.subject', function ($q) use ($activeClassroomId, $subjectId) {
                $q->where('classroom_id', $activeClassroomId);
                if ($subjectId) {
                    $q->where('id', $subjectId);
                }
            })
            ->with('material.quest.subject')
            ->latest();
            
        $bookmarks = $bookmarksQuery->get();

        return view('student.learning-room', compact('inProgressQuests', 'completedQuests', 'bookmarks', 'availableSubjects', 'subjectId'));
    }
}
