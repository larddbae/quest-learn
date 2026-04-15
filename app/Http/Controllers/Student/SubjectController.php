<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $subjects = Subject::where('classroom_id', $user->classroom_id)
            ->withCount('quests')
            ->get();

        return view('student.subjects.index', compact('subjects'));
    }
}
