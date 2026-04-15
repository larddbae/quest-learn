<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index(Subject $subject)
    {
        $this->authorizeSubject($subject);
        $quests = $subject->quests()->with('material.quizzes')->orderBy('order')->get();

        return view('admin.quests.index', compact('subject', 'quests'));
    }

    public function create(Subject $subject)
    {
        $this->authorizeSubject($subject);
        $nextOrder = $subject->quests()->max('order') + 1;

        return view('admin.quests.create', compact('subject', 'nextOrder'));
    }

    public function store(Request $request, Subject $subject)
    {
        $this->authorizeSubject($subject);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'xp_reward' => 'required|integer|min:1',
        ]);

        $subject->quests()->create($validated);

        return redirect()->route('admin.quests.index', $subject)
            ->with('success', 'Quest created!');
    }

    public function edit(Subject $subject, Quest $quest)
    {
        $this->authorizeSubject($subject);
        return view('admin.quests.edit', compact('subject', 'quest'));
    }

    public function update(Request $request, Subject $subject, Quest $quest)
    {
        $this->authorizeSubject($subject);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'xp_reward' => 'required|integer|min:1',
        ]);

        $quest->update($validated);

        return redirect()->route('admin.quests.index', $subject)
            ->with('success', 'Quest updated!');
    }

    public function destroy(Subject $subject, Quest $quest)
    {
        $this->authorizeSubject($subject);
        $quest->delete();

        return redirect()->route('admin.quests.index', $subject)
            ->with('success', 'Quest deleted.');
    }

    private function authorizeSubject(Subject $subject): void
    {
        if ($subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
