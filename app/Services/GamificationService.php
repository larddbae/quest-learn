<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Support\Facades\DB;

class GamificationService
{
    /**
     * Rank thresholds based on total XP.
     */
    private const RANK_THRESHOLDS = [
        'Diamond'  => 7000,
        'Platinum' => 3500,
        'Gold'     => 1500,
        'Silver'   => 500,
        'Bronze'   => 0,
    ];

    /**
     * Award XP to a user after completing a quest.
     * Wrapped in DB::transaction() for data integrity.
     */
    public function awardXP(User $user, int $xpAmount): void
    {
        DB::transaction(function () use ($user, $xpAmount) {
            $user->xp += $xpAmount;

            // Check for level ups (can level up multiple times)
            while ($user->xp >= $this->xpForLevel($user->level)) {
                $user->xp -= $this->xpForLevel($user->level);
                $user->level++;
            }

            // Update rank
            $user->rank = $this->calculateRank($user);

            $user->save();

            // Check for badge awards
            $this->checkBadges($user);
        });
    }

    /**
     * XP required to complete a given level.
     * Formula: Level * 100 * 1.5
     */
    public function xpForLevel(int $level): int
    {
        return (int) ($level * 100 * 1.5);
    }

    /**
     * Calculate rank based on total XP earned (cumulative).
     */
    public function calculateRank(User $user): string
    {
        $totalXP = $this->getTotalXPEarned($user);

        foreach (self::RANK_THRESHOLDS as $rank => $threshold) {
            if ($totalXP >= $threshold) {
                return $rank;
            }
        }

        return 'Bronze';
    }

    /**
     * Get total XP ever earned by the user (sum of all quest rewards).
     */
    public function getTotalXPEarned(User $user): int
    {
        return (int) UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->join('quests', 'user_progress.quest_id', '=', 'quests.id')
            ->sum('quests.xp_reward');
    }

    /**
     * Check and award badges based on criteria.
     */
    public function checkBadges(User $user): void
    {
        $completedQuests = UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();

        $perfectScores = UserProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->whereColumn('score', 'total_questions')
            ->count();

        $totalXP = $this->getTotalXPEarned($user);

        $badges = Badge::all();

        foreach ($badges as $badge) {
            // Skip if user already has this badge
            if ($user->badges()->where('badge_id', $badge->id)->exists()) {
                continue;
            }

            $earned = match ($badge->criteria_type) {
                'quests_completed' => $completedQuests >= $badge->criteria_value,
                'perfect_score'    => $perfectScores >= $badge->criteria_value,
                'xp_earned'        => $totalXP >= $badge->criteria_value,
                'level_reached'    => $user->level >= $badge->criteria_value,
                default            => false,
            };

            if ($earned) {
                $user->badges()->attach($badge->id, ['awarded_at' => now()]);
            }
        }
    }
}
