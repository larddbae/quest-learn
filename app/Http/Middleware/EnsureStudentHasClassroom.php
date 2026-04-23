<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudentHasClassroom
{
    /**
     * Ensure the authenticated student has an active classroom selected
     * in the session. All guild-related flows (zero guilds, multiple guilds,
     * invalid session) are consolidated into the Guild Hall (guild-select).
     *
     * Flow:
     * 1. No active_classroom_id in session → redirect to guild-select
     * 2. Session has an ID the user no longer belongs to → redirect to guild-select
     * 3. Valid session → proceed
     *
     * The guild-select page handles everything: joining a new guild,
     * selecting from existing ones, and auto-selecting when there's only one.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->isStudent()) {
            // Routes exempt from this middleware (prevent redirect loops)
            if ($request->routeIs(
                'student.guild-select',
                'student.guild-select.set',
                'student.join-class',
                'student.join-class.submit',
                'logout'
            )) {
                return $next($request);
            }

            $activeId = session('active_classroom_id');

            // No active session OR the stored ID is no longer valid
            if (!$activeId || !$user->classrooms()->where('classrooms.id', $activeId)->exists()) {
                // Auto-select if the student belongs to exactly one guild
                if ($user->classrooms()->count() === 1) {
                    session(['active_classroom_id' => $user->classrooms()->first()->id]);
                    return $next($request);
                }

                // Zero guilds or multiple guilds → Guild Hall handles it
                return redirect()->route('student.guild-select');
            }
        }

        return $next($request);
    }
}
