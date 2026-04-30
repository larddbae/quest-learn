<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $quests = Quest::whereHas('subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with(['subject.classroom', 'material.quizzes'])->orderBy('order')->get();

        return view('admin.quests.index', compact('quests'));
    }

    public function create()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        $subjects = Subject::whereIn('classroom_id', $classrooms)->with('classroom')->get();
        // default next order is 1 if no quests exist
        $nextOrder = 1;
        
        return view('admin.quests.create', compact('subjects', 'nextOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'xp_reward' => 'required|integer|min:1',
        ]);

        $subject = Subject::findOrFail($validated['subject_id']);
        $this->authorizeSubject($subject);

        $quest = $subject->quests()->create($validated);

        $students = $subject->classroom->students;
        if ($students->count() > 0) {
            \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\SystemAlert([
                'title' => 'New Quest Available!',
                'message' => "The quest '{$quest->title}' has been added to {$subject->name}.",
                'url' => route('student.quests.index', $subject->id),
                'icon' => 'explore',
                'icon_color' => 'primary-container',
            ]));
        }

        return redirect()->route('admin.quests.index')
            ->with('success', 'Quest created!');
    }

    public function edit(Quest $quest)
    {
        $this->authorizeSubject($quest->subject);
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        $subjects = Subject::whereIn('classroom_id', $classrooms)->with('classroom')->get();

        return view('admin.quests.edit', compact('quest', 'subjects'));
    }

    public function update(Request $request, Quest $quest)
    {
        $this->authorizeSubject($quest->subject);

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'xp_reward' => 'required|integer|min:1',
        ]);

        $newSubject = Subject::findOrFail($validated['subject_id']);
        $this->authorizeSubject($newSubject);

        $quest->update($validated);

        return redirect()->route('admin.quests.index')
            ->with('success', 'Quest updated!');
    }

    public function destroy(Quest $quest)
    {
        $this->authorizeSubject($quest->subject);
        $quest->delete();

        return redirect()->route('admin.quests.index')
            ->with('success', 'Quest deleted.');
    }

    private function authorizeSubject(Subject $subject): void
    {
        if ($subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
