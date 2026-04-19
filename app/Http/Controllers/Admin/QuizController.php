<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Material;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $quizzes = Quiz::whereHas('material.quest.subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('material.quest')->get();

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $materials = Material::whereHas('quest.subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('quest.subject.classroom')->get();
        
        return view('admin.quizzes.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $material = Material::findOrFail($validated['material_id']);
        $this->authorizeMaterial($material);

        $material->quizzes()->create($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz question added!');
    }

    public function edit(Quiz $quiz)
    {
        $this->authorizeMaterial($quiz->material);
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $materials = Material::whereHas('quest.subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('quest.subject.classroom')->get();

        return view('admin.quizzes.edit', compact('quiz', 'materials'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorizeMaterial($quiz->material);

        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $newMaterial = Material::findOrFail($validated['material_id']);
        $this->authorizeMaterial($newMaterial);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz question updated!');
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorizeMaterial($quiz->material);
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz question deleted.');
    }

    private function authorizeMaterial(Material $material): void
    {
        if ($material->quest->subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
