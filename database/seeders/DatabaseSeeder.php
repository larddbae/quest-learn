<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Order matters:
     *  1. BadgeSeeder      — static badge definitions (no foreign-key deps)
     *  2. QuestLearnSeeder — GM + Student accounts, Guilds, Subjects,
     *                        Quests, Materials, Quizzes, pivot enrollment
     */
    public function run(): void
    {
        $this->call([
            BadgeSeeder::class,
            QuestLearnSeeder::class,
        ]);
    }
}
