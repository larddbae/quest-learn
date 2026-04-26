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
        $activeClassroomId = (int) session('active_classroom_id');

        if ($quest->subject->classroom_id !== $activeClassroomId) {
            abort(403);
        }

        if (!$quest->isUnlockedFor($user)) {
            return back()->with('error', 'This quest is still locked!');
        }

        // Check if already completed — redirect to review instead of bouncing back
        $existingProgress = UserProgress::where('user_id', $user->id)
            ->where('quest_id', $quest->id)
            ->where('is_completed', true)
            ->first();

        if ($existingProgress) {
            return redirect()->route('student.quizzes.review', $quest)
                ->with('info', 'You have already completed this quest! Review your answers below.');
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
        $activeClassroomId = (int) session('active_classroom_id');

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
        $resultsForView = [];
        $answersForDb = [];

        foreach ($quizzes as $quiz) {
            $answer = $request->input('quiz_' . $quiz->id);
            $isCorrect = $answer === $quiz->correct_answer;

            if ($isCorrect) {
                $score++;
            }

            $answersForDb[] = [
                'quiz_id' => $quiz->id,
                'user_answer' => $answer,
                'is_correct' => $isCorrect,
            ];

            $resultsForView[] = [
                'quiz' => $quiz,
                'user_answer' => $answer,
                'is_correct' => $isCorrect,
            ];
        }

        // Create progress record with answers JSON
        $progress = UserProgress::create([
            'user_id' => $user->id,
            'quest_id' => $quest->id,
            'is_completed' => true,
            'score' => $score,
            'total_questions' => $quizzes->count(),
            'answers' => $answersForDb,
            'completed_at' => now(),
        ]);

        // Award XP through GamificationService
        $gamificationService->awardXP($user, $quest->xp_reward);

        return view('student.quizzes.results', [
            'quest' => $quest, 
            'results' => $resultsForView, 
            'score' => $score, 
            'progress' => $progress
        ]);
    }

    /**
     * Show quiz review for a completed quest.
     * Displays questions with user answers vs correct answers (read-only).
     */
    public function review(Quest $quest)
    {
        $user = auth()->user();
        $activeClassroomId = (int) session('active_classroom_id');

        if ($quest->subject->classroom_id !== $activeClassroomId) {
            abort(403);
        }

        $progress = UserProgress::where('user_id', $user->id)
            ->where('quest_id', $quest->id)
            ->where('is_completed', true)
            ->firstOrFail();

        $material = $quest->material;
        $quizzes = $material ? $material->quizzes : collect();

        // Reconstruct results from stored answers
        $results = [];
        $answersData = $progress->answers; // decoded JSON array

        if ($answersData && is_array($answersData)) {
            foreach ($quizzes as $quiz) {
                // Find this quiz's answer from stored data
                $storedAnswer = collect($answersData)->firstWhere('quiz_id', $quiz->id);

                $results[] = [
                    'quiz' => $quiz,
                    'user_answer' => $storedAnswer['user_answer'] ?? null,
                    'is_correct' => $storedAnswer['is_correct'] ?? false,
                ];
            }
        }

        return view('student.quizzes.review', compact('quest', 'progress', 'results', 'quizzes'));
    }
}
