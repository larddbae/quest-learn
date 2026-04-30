<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $subjects = Subject::whereIn('classroom_id', $classrooms)
            ->with('classroom')
            ->withCount('quests')
            ->get();

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classrooms = auth()->user()->ownedClassrooms;
        return view('admin.subjects.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        $this->authorizeClassroom($classroom);

        $subject = $classroom->subjects()->create($validated);

        $students = $classroom->students;
        if ($students->count() > 0) {
            \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\SystemAlert([
                'title' => 'New Subject Added!',
                'message' => "The subject '{$subject->name}' is now available.",
                'url' => route('student.subjects.index'),
                'icon' => 'menu_book',
                'icon_color' => 'secondary-container',
            ]));
        }

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject created!');
    }

    public function edit(Subject $subject)
    {
        $this->authorizeClassroom($subject->classroom);
        $classrooms = auth()->user()->ownedClassrooms;
        return view('admin.subjects.edit', compact('subject', 'classrooms'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->authorizeClassroom($subject->classroom);

        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $newClassroom = Classroom::findOrFail($validated['classroom_id']);
        $this->authorizeClassroom($newClassroom);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject updated!');
    }

    public function destroy(Subject $subject)
    {
        $this->authorizeClassroom($subject->classroom);
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject deleted.');
    }

    private function authorizeClassroom(Classroom $classroom): void
    {
        if ($classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
