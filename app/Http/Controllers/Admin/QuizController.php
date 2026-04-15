<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Quest;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Quest $quest)
    {
        $this->authorizeQuest($quest);
        $material = $quest->material;

        if (!$material) {
            return redirect()->route('admin.materials.create', $quest)
                ->with('error', 'Add material before creating quizzes.');
        }

        $quizzes = $material->quizzes;

        return view('admin.quizzes.index', compact('quest', 'material', 'quizzes'));
    }

    public function create(Quest $quest)
    {
        $this->authorizeQuest($quest);
        return view('admin.quizzes.create', compact('quest'));
    }

    public function store(Request $request, Quest $quest)
    {
        $this->authorizeQuest($quest);

        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $quest->material->quizzes()->create($validated);

        return redirect()->route('admin.quizzes.index', $quest)
            ->with('success', 'Quiz question added!');
    }

    public function edit(Quest $quest, Quiz $quiz)
    {
        $this->authorizeQuest($quest);
        return view('admin.quizzes.edit', compact('quest', 'quiz'));
    }

    public function update(Request $request, Quest $quest, Quiz $quiz)
    {
        $this->authorizeQuest($quest);

        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index', $quest)
            ->with('success', 'Quiz question updated!');
    }

    public function destroy(Quest $quest, Quiz $quiz)
    {
        $this->authorizeQuest($quest);
        $quiz->delete();

        return redirect()->route('admin.quizzes.index', $quest)
            ->with('success', 'Quiz question deleted.');
    }

    private function authorizeQuest(Quest $quest): void
    {
        if ($quest->subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
