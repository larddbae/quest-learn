<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudentHasClassroom
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->isStudent() && !$user->classroom_id) {
            // Allow access to join-class route and logout
            if (!$request->routeIs('student.join-class') && !$request->routeIs('student.join-class.submit') && !$request->routeIs('logout')) {
                return redirect()->route('student.join-class');
            }
        }

        return $next($request);
    }
}
