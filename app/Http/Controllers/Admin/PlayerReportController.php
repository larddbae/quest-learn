<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class PlayerReportController extends Controller
{
    public function show(User $user): View
    {
        if (!$user->isStudent()) {
            abort(404);
        }

        $user->load('badges');

        $userProgress = $user->progress()
            ->with(['quest.subject'])
            ->orderByDesc('updated_at')
            ->get();

        $completedQuests = $userProgress->where('is_completed', true);

        return view('admin.players.show', [
            'student' => $user,
            'userProgress' => $userProgress,
            'completedQuests' => $completedQuests,
        ]);
    }
}
