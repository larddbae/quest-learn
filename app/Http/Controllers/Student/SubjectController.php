<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeClassroomId = session('active_classroom_id');

        $subjects = Subject::where('classroom_id', $activeClassroomId)
            ->withCount('quests')
            ->get();

        return view('student.subjects.index', compact('subjects'));
    }
}
