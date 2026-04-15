<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;

class QuestBuilderController extends Controller
{
    /**
     * Quest Builder — comprehensive overview of all classrooms, subjects,
     * quests, materials, and quizzes for the teacher.
     */
    public function index()
    {
        $teacher = auth()->user();

        $classrooms = $teacher->ownedClassrooms()
            ->with(['subjects' => function ($q) {
                $q->withCount('quests');
            }, 'subjects.quests' => function ($q) {
                $q->orderBy('order');
            }, 'subjects.quests.material.quizzes'])
            ->get();

        // Aggregate stats
        $totalSubjects = 0;
        $totalQuests = 0;
        $totalMaterials = 0;
        $totalQuizzes = 0;

        foreach ($classrooms as $classroom) {
            foreach ($classroom->subjects as $subject) {
                $totalSubjects++;
                foreach ($subject->quests as $quest) {
                    $totalQuests++;
                    if ($quest->material) {
                        $totalMaterials++;
                        $totalQuizzes += $quest->material->quizzes->count();
                    }
                }
            }
        }

        return view('admin.quest-builder', compact(
            'classrooms', 'totalSubjects', 'totalQuests', 'totalMaterials', 'totalQuizzes'
        ));
    }
}
