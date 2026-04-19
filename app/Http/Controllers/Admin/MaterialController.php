<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quest;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        
        $materials = Material::whereHas('quest.subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('quest.subject.classroom')->get();

        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        $quests = Quest::whereHas('subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('subject.classroom')->get();
        // optionally, we might only want to show quests that DON'T have a material yet:
        // $quests = $quests->whereNull('material'); -> but keeping it simple for now or let validation handle it.
        
        return view('admin.materials.create', compact('quests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quest_id' => 'required|exists:quests,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $quest = Quest::findOrFail($validated['quest_id']);
        $this->authorizeQuest($quest);

        if ($quest->material) {
            return redirect()->back()->withErrors(['quest_id' => 'This quest already has a material.']);
        }

        $quest->material()->create($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Material added to quest!');
    }

    public function edit(Material $material)
    {
        $this->authorizeQuest($material->quest);
        $teacher = auth()->user();
        $classrooms = $teacher->ownedClassrooms()->pluck('id');
        $quests = Quest::whereHas('subject', function($q) use ($classrooms) {
            $q->whereIn('classroom_id', $classrooms);
        })->with('subject.classroom')->get();

        return view('admin.materials.edit', compact('material', 'quests'));
    }

    public function update(Request $request, Material $material)
    {
        $this->authorizeQuest($material->quest);

        $validated = $request->validate([
            'quest_id' => 'required|exists:quests,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $newQuest = Quest::findOrFail($validated['quest_id']);
        $this->authorizeQuest($newQuest);

        if ($newQuest->id !== $material->quest_id && $newQuest->material) {
            return redirect()->back()->withErrors(['quest_id' => 'The new quest already has a material.']);
        }

        // if quest changed, we would need to update the quest_id.
        // Material is a one-to-one relation with Quest on quest_id
        $material->update($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Material updated!');
    }

    public function destroy(Material $material)
    {
        $this->authorizeQuest($material->quest);
        $material->delete();

        return redirect()->route('admin.materials.index')
            ->with('success', 'Material deleted.');
    }

    private function authorizeQuest(Quest $quest): void
    {
        if ($quest->subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
