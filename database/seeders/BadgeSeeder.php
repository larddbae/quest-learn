<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name' => 'First Blood',
                'description' => 'Complete your very first quest!',
                'criteria_type' => 'quests_completed',
                'criteria_value' => 1,
            ],
            [
                'name' => 'Quest Hunter',
                'description' => 'Complete 5 quests. You\'re on a roll!',
                'criteria_type' => 'quests_completed',
                'criteria_value' => 5,
            ],
            [
                'name' => 'Quest Master',
                'description' => 'Complete 10 quests. A true adventurer!',
                'criteria_type' => 'quests_completed',
                'criteria_value' => 10,
            ],
            [
                'name' => 'Legend',
                'description' => 'Complete 25 quests. You are a legend!',
                'criteria_type' => 'quests_completed',
                'criteria_value' => 25,
            ],
            [
                'name' => 'Perfectionist',
                'description' => 'Get a perfect score on a quiz!',
                'criteria_type' => 'perfect_score',
                'criteria_value' => 1,
            ],
            [
                'name' => 'Flawless',
                'description' => 'Get 5 perfect scores. Impressive!',
                'criteria_type' => 'perfect_score',
                'criteria_value' => 5,
            ],
            [
                'name' => 'XP Collector',
                'description' => 'Earn 500 total XP.',
                'criteria_type' => 'xp_earned',
                'criteria_value' => 500,
            ],
            [
                'name' => 'XP Hoarder',
                'description' => 'Earn 2000 total XP.',
                'criteria_type' => 'xp_earned',
                'criteria_value' => 2000,
            ],
            [
                'name' => 'Level 5',
                'description' => 'Reach level 5. The journey begins!',
                'criteria_type' => 'level_reached',
                'criteria_value' => 5,
            ],
            [
                'name' => 'Level 10',
                'description' => 'Reach level 10. You\'re getting stronger!',
                'criteria_type' => 'level_reached',
                'criteria_value' => 10,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }
    }
}
