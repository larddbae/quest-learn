<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'criteria_type' => 'required|in:quests_completed,perfect_score,xp_earned,level_reached',
            'criteria_value' => 'required|integer|min:1',
            'icon' => 'nullable|image|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('badges', 'public');
        }

        Badge::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'criteria_type' => $validated['criteria_type'],
            'criteria_value' => $validated['criteria_value'],
            'icon_path' => $iconPath,
        ]);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge forged successfully! ⚒️');
    }

    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'criteria_type' => 'required|in:quests_completed,perfect_score,xp_earned,level_reached',
            'criteria_value' => 'required|integer|min:1',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $badge->icon_path = $request->file('icon')->store('badges', 'public');
        }

        $badge->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'criteria_type' => $validated['criteria_type'],
            'criteria_value' => $validated['criteria_value'],
            'icon_path' => $badge->icon_path,
        ]);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge updated!');
    }

    public function destroy(Badge $badge)
    {
        $badge->delete();
        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge destroyed. 💀');
    }
}
