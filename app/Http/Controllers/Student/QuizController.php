<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\UserProgress;
use App\Services\GamificationService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quest $quest)
    {
        $user = auth()->user();
        $activeClassroomId = session('active_classroom_id');

        if ($quest->subject->classroom_id !== $activeClassroomId) {
            abort(403);
        }

        if (!$quest->isUnlockedFor($user)) {
            return back()->with('error', 'This quest is still locked!');
        }

        // Check if already completed
        $existingProgress = UserProgress::where('user_id', $user->id)
            ->where('quest_id', $quest->id)
            ->where('is_completed', true)
            ->first();

        if ($existingProgress) {
            return back()->with('info', 'You have already completed this quest! Score: ' . $existingProgress->score . '/' . $existingProgress->total_questions);
        }

        $material = $quest->material;
        if (!$material) {
            return back()->with('error', 'No material available for this quest.');
        }

        $quizzes = $material->quizzes;

        if ($quizzes->isEmpty()) {
            return back()->with('error', 'No quizzes available for this quest yet.');
        }

        return view('student.quizzes.show', compact('quest', 'quizzes'));
    }

    public function submit(Request $request, Quest $quest, GamificationService $gamificationService)
    {
        $user = auth()->user();
        $activeClassroomId = session('active_classroom_id');

        if ($quest->subject->classroom_id !== $activeClassroomId) {
            abort(403);
        }

        // Prevent double submission
        $existingProgress = UserProgress::where('user_id', $user->id)
            ->where('quest_id', $quest->id)
            ->where('is_completed', true)
            ->first();

        if ($existingProgress) {
            return redirect()->route('student.quests.index', $quest->subject_id)
                ->with('info', 'Quest already completed!');
        }

        $material = $quest->material;
        $quizzes = $material->quizzes;

        $score = 0;
        $results = [];

        foreach ($quizzes as $quiz) {
            $answer = $request->input('quiz_' . $quiz->id);
            $isCorrect = $answer === $quiz->correct_answer;

            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'quiz' => $quiz,
                'user_answer' => $answer,
                'is_correct' => $isCorrect,
            ];
        }

        // Create progress record
        $progress = UserProgress::create([
            'user_id' => $user->id,
            'quest_id' => $quest->id,
            'is_completed' => true,
            'score' => $score,
            'total_questions' => $quizzes->count(),
            'completed_at' => now(),
        ]);

        // Award XP through GamificationService
        $gamificationService->awardXP($user, $quest->xp_reward);

        return view('student.quizzes.results', compact('quest', 'results', 'score', 'progress'));
    }
}
