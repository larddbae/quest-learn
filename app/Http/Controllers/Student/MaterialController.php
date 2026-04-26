<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Quest;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function show(Quest $quest)
    {
        $user = auth()->user();
        $activeClassroomId = (int) session('active_classroom_id');

        // Verify quest belongs to user's active classroom
        if ($quest->subject->classroom_id !== $activeClassroomId) {
            abort(403);
        }

        // Verify quest is unlocked
        if (!$quest->isUnlockedFor($user)) {
            return back()->with('error', 'This quest is still locked! Complete previous quests first.');
        }

        $material = $quest->material;
        if (!$material) {
            return back()->with('error', 'No material available for this quest yet.');
        }

        $isBookmarked = Bookmark::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->exists();

        $quizCount = $material->quizzes()->count();

        return view('student.materials.show', compact('quest', 'material', 'isBookmarked', 'quizCount'));
    }

    public function toggleBookmark(Request $request, $materialId)
    {
        $user = auth()->user();

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('material_id', $materialId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Bookmark removed!');
        }

        Bookmark::create([
            'user_id' => $user->id,
            'material_id' => $materialId,
        ]);

        return back()->with('success', 'Material bookmarked! 📚');
    }
}
