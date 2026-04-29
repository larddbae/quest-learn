<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class GuildSelectController extends Controller
{
    /**
     * Show the guild selection page.
     * Includes user's guilds and public guilds directory.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $classroomsQuery = $user->classrooms()
            ->with('teacher')
            ->withCount(['users', 'subjects']);

        // Apply search filter to user's own guilds
        if ($request->filled('search')) {
            $search = $request->input('search');
            $classroomsQuery->where(function ($q) use ($search) {
                $q->where('classrooms.name', 'like', "%{$search}%")
                  ->orWhereHas('teacher', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $classrooms = $classroomsQuery->get();

        // Get the user's joined classroom IDs to exclude from public listing
        $joinedIds = $classrooms->pluck('id')->toArray();

        // Query public guilds the user hasn't joined yet
        $publicGuildsQuery = Classroom::where('visibility', 'public')
            ->whereNotIn('id', $joinedIds)
            ->with('teacher')
            ->withCount(['users', 'subjects']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $publicGuildsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('teacher', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $publicGuilds = $publicGuildsQuery->latest()->paginate(6);
        $tab = $request->input('tab', 'all');

        return view('student.guild-select', compact('classrooms', 'publicGuilds', 'tab'));
    }

    /**
     * Set the active classroom (guild) in the session.
     */
    public function set(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|integer',
        ]);

        $user = auth()->user();

        // Verify the user is actually a member of this classroom
        if (!$user->classrooms()->where('classrooms.id', $request->classroom_id)->exists()) {
            abort(403, 'You are not a member of this guild.');
        }

        session(['active_classroom_id' => $request->classroom_id]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Guild switched successfully! ⚔️');
    }

    /**
     * Instantly join a public guild (no join code required).
     */
    public function joinPublic(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|integer',
        ]);

        $classroom = Classroom::where('id', $request->classroom_id)
            ->where('visibility', 'public')
            ->firstOrFail();

        $user = auth()->user();

        // Prevent duplicate joins
        if ($user->classrooms()->where('classrooms.id', $classroom->id)->exists()) {
            return redirect()->route('student.guild-select')
                ->with('info', 'You are already a member of this guild.');
        }

        $user->classrooms()->attach($classroom->id);
        session(['active_classroom_id' => $classroom->id]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Joined "' . $classroom->name . '" successfully! ⚔️');
    }
}
