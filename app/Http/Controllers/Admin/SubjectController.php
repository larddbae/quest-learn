<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);
        $subjects = $classroom->subjects()->withCount('quests')->get();

        return view('admin.subjects.index', compact('classroom', 'subjects'));
    }

    public function create(Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);
        return view('admin.subjects.create', compact('classroom'));
    }

    public function store(Request $request, Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $classroom->subjects()->create($validated);

        return redirect()->route('admin.subjects.index', $classroom)
            ->with('success', 'Subject created!');
    }

    public function edit(Classroom $classroom, Subject $subject)
    {
        $this->authorizeClassroom($classroom);
        return view('admin.subjects.edit', compact('classroom', 'subject'));
    }

    public function update(Request $request, Classroom $classroom, Subject $subject)
    {
        $this->authorizeClassroom($classroom);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index', $classroom)
            ->with('success', 'Subject updated!');
    }

    public function destroy(Classroom $classroom, Subject $subject)
    {
        $this->authorizeClassroom($classroom);
        $subject->delete();

        return redirect()->route('admin.subjects.index', $classroom)
            ->with('success', 'Subject deleted.');
    }

    private function authorizeClassroom(Classroom $classroom): void
    {
        if ($classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
