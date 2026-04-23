<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = auth()->user()->ownedClassrooms()
            ->withCount('students')
            ->latest()
            ->get();

        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view('admin.classrooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visibility' => 'required|in:public,private',
        ]);

        $classroom = Classroom::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'visibility' => $validated['visibility'],
            'teacher_id' => auth()->id(),
        ]);

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Guild "' . $classroom->name . '" created! Join Code: ' . $classroom->join_code);
    }

    public function show(Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);

        $students = $classroom->students()
            ->orderByRaw("FIELD(rank, 'Diamond', 'Platinum', 'Gold', 'Silver', 'Bronze')")
            ->orderBy('level', 'desc')
            ->orderBy('xp', 'desc')
            ->get();

        return view('admin.classrooms.show', compact('classroom', 'students'));
    }

    public function edit(Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);
        return view('admin.classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visibility' => 'required|in:public,private',
        ]);

        $classroom->update($validated);

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Guild updated!');
    }

    public function destroy(Classroom $classroom)
    {
        $this->authorizeClassroom($classroom);
        $classroom->delete();

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Guild deleted.');
    }

    private function authorizeClassroom(Classroom $classroom): void
    {
        if ($classroom->teacher_id !== auth()->id()) {
            abort(403, 'You do not own this guild.');
        }
    }
}
