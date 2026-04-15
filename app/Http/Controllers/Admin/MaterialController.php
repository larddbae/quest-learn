<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quest;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function create(Quest $quest)
    {
        $this->authorizeQuest($quest);

        // If material already exists, redirect to edit
        if ($quest->material) {
            return redirect()->route('admin.materials.edit', $quest);
        }

        return view('admin.materials.create', compact('quest'));
    }

    public function store(Request $request, Quest $quest)
    {
        $this->authorizeQuest($quest);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $quest->material()->create($validated);

        return redirect()->route('admin.quests.index', $quest->subject)
            ->with('success', 'Material added to quest!');
    }

    public function edit(Quest $quest)
    {
        $this->authorizeQuest($quest);
        $material = $quest->material;

        if (!$material) {
            return redirect()->route('admin.materials.create', $quest);
        }

        return view('admin.materials.edit', compact('quest', 'material'));
    }

    public function update(Request $request, Quest $quest)
    {
        $this->authorizeQuest($quest);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $quest->material->update($validated);

        return redirect()->route('admin.quests.index', $quest->subject)
            ->with('success', 'Material updated!');
    }

    private function authorizeQuest(Quest $quest): void
    {
        if ($quest->subject->classroom->teacher_id !== auth()->id()) {
            abort(403);
        }
    }
}
