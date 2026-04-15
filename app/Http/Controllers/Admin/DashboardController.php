<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->withCount('students')->get();

        $totalStudents = $classrooms->sum('students_count');
        $totalClassrooms = $classrooms->count();

        return view('admin.dashboard', compact('classrooms', 'totalStudents', 'totalClassrooms'));
    }
}
