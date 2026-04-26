<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Material;
use App\Models\Quest;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QuestLearnSeeder extends Seeder
{
    // ─────────────────────────────────────────────────────────────
    //  GUILD DATA  (name, description, visibility)
    // ─────────────────────────────────────────────────────────────
    private array $guilds = [
        [
            'name'        => 'The Arithmancers Guild',
            'description' => 'Masters of arcane mathematics who bend numbers to their will. Only the worthy may enter.',
            'visibility'  => 'private',
        ],
        [
            'name'        => 'Order of the Binary Code',
            'description' => 'An ancient brotherhood devoted to the sacred art of programming and digital sorcery.',
            'visibility'  => 'public',
        ],
        [
            'name'        => 'Scribes of the Ancient Lore',
            'description' => 'Keepers of wisdom and literature, who decipher the oldest scrolls across the realm.',
            'visibility'  => 'public',
        ],
        [
            'name'        => 'The Celestial Cartographers',
            'description' => 'Navigators of both star and science, charting the unknown frontiers of the universe.',
            'visibility'  => 'private',
        ],
        [
            'name'        => 'Iron Forge Artificers',
            'description' => 'Engineers and inventors who craft legendary contraptions from raw knowledge and iron will.',
            'visibility'  => 'public',
        ],
    ];

    // ─────────────────────────────────────────────────────────────
    //  SUBJECT DATA  keyed by guild index (0-based)
    // ─────────────────────────────────────────────────────────────
    private array $subjects = [
        // Guild 0: The Arithmancers Guild
        0 => [
            ['name' => 'Runic Algebra', 'description' => 'Decode the mystical symbols of algebraic runes and bend equations to your will.', 'icon' => '🔢'],
            ['name' => 'Geometry of the Ancients', 'description' => 'Study the sacred shapes carved into the dungeon walls by the Archmages of old.', 'icon' => '📐'],
            ['name' => 'Forbidden Calculus', 'description' => 'A dangerous grimoire of limits, derivatives, and integrals — approach with caution.', 'icon' => '📈'],
        ],
        // Guild 1: Order of the Binary Code
        1 => [
            ['name' => 'The Art of Spellscripting', 'description' => 'Cast powerful incantations using the ancient language of Python and its serpentine syntax.', 'icon' => '🐍'],
            ['name' => 'Web Enchantment', 'description' => 'Weave HTML and CSS spells to construct portals and magical interfaces for the realm.', 'icon' => '🕸️'],
            ['name' => 'Database Dungeon Crawling', 'description' => 'Venture deep into relational dungeons to loot data and forge powerful SQL queries.', 'icon' => '🗄️'],
        ],
        // Guild 2: Scribes of the Ancient Lore
        2 => [
            ['name' => 'Chronicles of Grammar', 'description' => 'Wield the sword of proper sentence structure and slay the demon of grammatical error.', 'icon' => '📜'],
            ['name' => 'Epic Poetry & Verse', 'description' => 'Master the bardic arts of meter, rhyme, and verse to craft legendary battle poems.', 'icon' => '🪶'],
        ],
        // Guild 3: The Celestial Cartographers
        3 => [
            ['name' => 'Alchemy of Physics', 'description' => 'Transform raw understanding of forces and motion into pure analytical gold.', 'icon' => '⚛️'],
            ['name' => 'Star Charts & Astronomy', 'description' => 'Navigate the cosmos using scroll-maps of celestial bodies and gravitational lore.', 'icon' => '🌌'],
            ['name' => 'Biology of Mythical Beasts', 'description' => 'Dissect and study the anatomy of legendary creatures using the Tome of Life Sciences.', 'icon' => '🐉'],
        ],
        // Guild 4: Iron Forge Artificers
        4 => [
            ['name' => 'Blueprints of Invention', 'description' => 'Study engineering blueprints left behind by legendary artificers to build your own gadgets.', 'icon' => '⚙️'],
            ['name' => 'Circuit Sorcery', 'description' => 'Harness the invisible flow of electrons through copper pathways and logic gates.', 'icon' => '⚡'],
        ],
    ];

    // ─────────────────────────────────────────────────────────────
    //  QUEST DATA  keyed by subject index within each guild
    // ─────────────────────────────────────────────────────────────
    private array $questTemplates = [
        // Used dynamically – see buildQuestsForSubject()
        'prefixes' => ['Defeat', 'Uncover', 'Forge', 'Banish', 'Decode', 'Retrieve', 'Conquer', 'Unlock', 'Survive', 'Transcribe'],
        'objects'  => ['the Shadow Theorem', 'the Dungeon of Variables', 'the Scroll of Derivatives', 'the Boss of Recursion', 'the Forbidden Formula', 'the Ancient Cipher', 'the Dragon of Equations', 'the Crystal of Logic', 'the Ruins of Syntax', 'the Labyrinth of Data'],
    ];

    // ─────────────────────────────────────────────────────────────
    //  MATERIAL & QUIZ TEMPLATES
    // ─────────────────────────────────────────────────────────────
    private array $materialTemplates = [
        [
            'title'   => 'The Grand Scroll of Introduction',
            'content' => "# Welcome, Adventurer!\n\nThis sacred scroll contains the foundational lore of your quest. Read carefully — the Boss at the end will test your knowledge.\n\n## Core Concepts\nEvery great adventurer begins by understanding the basics. In this lore entry, you will:\n- Master the fundamental principles\n- Understand how the ancient rules apply to modern battles\n- Prepare yourself for the Trial of Understanding\n\n## The Ancient Formula\nThe great mages discovered that all knowledge follows a pattern. Study this pattern, for the quiz boss will invoke it without warning.\n\n> *\"Only those who read the scroll in full shall pass through the dungeon gate.\"* — High Mage Eloquent\n\n## Practice Ritual\nBefore facing the quiz, attempt these warm-up incantations in your own grimoire (notebook). True mastery requires repetition.",
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ],
        [
            'title'   => 'The Forbidden Codex: Advanced Lore',
            'content' => "# Forbidden Codex — Advanced Lore\n\nWarning: This codex contains knowledge banned by the Wizard Council. Proceed only if your previous quest is complete.\n\n## Deep Dive: The Boss Mechanics\nThe dungeon boss in this chapter employs three devastating attack patterns. You must understand all three to survive:\n\n1. **The Derivative Strike** – A rapid, pinpoint attack. Requires counter-knowledge of the chain rule.\n2. **The Recursive Barrage** – An infinite loop of attacks. Only a base-case spell can break it.\n3. **The Null Pointer Curse** – Causes all logic to fail. Defend with proper validation wards.\n\n## Legendary Artifacts\nUnlocking this quest rewards you with the **Amulet of Comprehension (+50 INT)**. Use it wisely.\n\n## Boss Checkpoint Quiz\nYour mastery will be tested in a 4-question arena battle. Achieve 75% or higher to claim your XP reward.",
            'video_url' => null,
        ],
        [
            'title'   => 'Field Notes from the Dungeon',
            'content' => "# Field Notes — Compiled by Explorer Faction VII\n\nThese notes were recovered from adventurers who survived the trial. Study them, as they contain firsthand battle strategies.\n\n## Observation Log\n*Day 1*: Entered the chamber. The walls were covered in equations. One wrong step and the floor crumbles.\n\n*Day 3*: Discovered the pattern. The enemy uses a consistent algorithm — predictable once you understand the base theory.\n\n*Day 7*: Reached the Boss Chamber. Armed with this codex, we prevailed. The key insight is stored in section 3.4.\n\n## Section 3.4 — The Key Insight\nAll problems in this domain reduce to a single, elegant truth. Master it, and no enemy can stand before you.\n\n## Summary Scroll\n- Know your foundations\n- Practice the core formula until it is second nature\n- Do not skip the warm-up quests — they weaken the Boss for you",
            'video_url' => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
        ],
    ];

    private array $quizSets = [
        // Quiz set 0
        [
            ['question' => 'What is the primary weapon of a true Arithmancer?', 'a' => 'The sword of logic', 'b' => 'The shield of ignorance', 'c' => 'The axe of brute force', 'd' => 'The wand of guessing', 'correct' => 'a'],
            ['question' => 'Which ancient technique allows a mage to solve for an unknown variable?', 'a' => 'Alchemy', 'b' => 'Divination', 'c' => 'Algebraic Manipulation', 'd' => 'Shouting at the scroll', 'correct' => 'c'],
            ['question' => 'The dungeon boss requires you to simplify: 2x + 4 = 10. What is x?', 'a' => '2', 'b' => '3', 'c' => '5', 'd' => '7', 'correct' => 'b'],
        ],
        // Quiz set 1
        [
            ['question' => 'In the Order of the Binary Code, a TRUE value is represented by which integer?', 'a' => '0', 'b' => '1', 'c' => '-1', 'd' => '∞', 'correct' => 'b'],
            ['question' => 'A "loop" in spellscripting is used to:', 'a' => 'Cast a spell once and forget it', 'b' => 'Repeat a block of code until a condition is met', 'c' => 'Delete memory from the scroll', 'd' => 'Summon a random variable from the void', 'correct' => 'b'],
            ['question' => 'Which keyword in Python is used to define a new spell (function)?', 'a' => 'cast', 'b' => 'spell', 'c' => 'def', 'd' => 'invoke', 'correct' => 'c'],
            ['question' => 'What does HTML stand for in the ancient Web Enchantment texts?', 'a' => 'Hyper Text Markup Language', 'b' => 'High Tier Magic Language', 'c' => 'Hidden Tome of Mystical Lore', 'd' => 'Heroic Terminal Markup Lexicon', 'correct' => 'a'],
        ],
        // Quiz set 2
        [
            ['question' => 'A subject in a sentence is best defined as:', 'a' => 'The action being performed', 'b' => 'The person or thing the sentence is about', 'c' => 'A descriptive word for the noun', 'd' => 'The object receiving the action', 'correct' => 'b'],
            ['question' => 'Which poetic device involves the repetition of initial consonant sounds?', 'a' => 'Assonance', 'b' => 'Onomatopoeia', 'c' => 'Alliteration', 'd' => 'Metaphor', 'correct' => 'c'],
        ],
        // Quiz set 3
        [
            ['question' => "Newton's First Law states that an object at rest will:", 'a' => 'Accelerate at 9.8 m/s²', 'b' => 'Remain at rest unless acted upon by an external force', 'c' => 'Attract other objects with mass', 'd' => 'Emit a field of dark energy', 'correct' => 'b'],
            ['question' => 'The closest star to our solar system is:', 'a' => 'Betelgeuse', 'b' => 'Sirius', 'c' => 'Proxima Centauri', 'd' => 'Vega', 'correct' => 'c'],
            ['question' => 'The powerhouse of the cell is the:', 'a' => 'Nucleus', 'b' => 'Ribosome', 'c' => 'Endoplasmic Reticulum', 'd' => 'Mitochondria', 'correct' => 'd'],
        ],
        // Quiz set 4
        [
            ['question' => 'In circuit sorcery, Ohm\'s Law states: V = ?', 'a' => 'I × R', 'b' => 'P / I', 'c' => 'R / I', 'd' => 'I + R', 'correct' => 'a'],
            ['question' => 'Which component in a circuit allows current to flow in only one direction?', 'a' => 'Resistor', 'b' => 'Capacitor', 'c' => 'Diode', 'd' => 'Transistor (in its default state)', 'correct' => 'c'],
        ],
    ];

    // ─────────────────────────────────────────────────────────────
    //  MAIN RUN METHOD
    // ─────────────────────────────────────────────────────────────
    public function run(): void
    {
        $this->command->info('⚔️  QuestLearn Seeder — Beginning world generation...');

        // 1. Static accounts
        $gm      = $this->createGm();
        $student = $this->createStudent();

        $this->command->info('✅  Static accounts created (GM & Student)');

        // 2. Guilds (Classrooms) owned by the GM
        $classrooms = $this->createGuilds($gm);

        $this->command->info('✅  5 Guilds created');

        // 3. Enroll student in guild 0 and guild 1 (index-based)
        $classrooms[0]->users()->syncWithoutDetaching([$student->id]);
        $classrooms[1]->users()->syncWithoutDetaching([$student->id]);

        $this->command->info('✅  Student enrolled in 2 guilds');

        // 4. Subjects, Quests, Materials, Quizzes per guild
        foreach ($classrooms as $guildIndex => $classroom) {
            $subjectDefs = $this->subjects[$guildIndex] ?? [];
            foreach ($subjectDefs as $subjectIndex => $subjectData) {
                $subject = Subject::create([
                    'name'         => $subjectData['name'],
                    'description'  => $subjectData['description'],
                    'icon'         => $subjectData['icon'],
                    'classroom_id' => $classroom->id,
                ]);

                $this->createQuestsForSubject($subject, $guildIndex, $subjectIndex);
            }
        }

        $this->command->info('✅  Subjects, Quests, Materials & Quizzes generated');
        $this->command->info('🏆  World generation complete! Happy bug hunting.');
    }

    // ─────────────────────────────────────────────────────────────
    //  HELPER: Create static accounts
    // ─────────────────────────────────────────────────────────────
    private function createGm(): User
    {
        return User::firstOrCreate(
            ['email' => 'gm@questlearn.com'],
            [
                'name'     => 'Archmage (Game Master)',
                'password' => Hash::make('password'),
                'role'     => 'teacher',
                'xp'       => 9999,
                'level'    => 99,
                'rank'     => 'Legendary Archmage',
            ]
        );
    }

    private function createStudent(): User
    {
        return User::firstOrCreate(
            ['email' => 'student@questlearn.com'],
            [
                'name'     => 'Kael the Apprentice',
                'password' => Hash::make('password'),
                'role'     => 'student',
                'xp'       => 350,
                'level'    => 4,
                'rank'     => 'Apprentice',
            ]
        );
    }

    // ─────────────────────────────────────────────────────────────
    //  HELPER: Create guilds (classrooms)
    // ─────────────────────────────────────────────────────────────
    private function createGuilds(User $gm): array
    {
        $classrooms = [];
        foreach ($this->guilds as $guildData) {
            $classrooms[] = Classroom::create([
                'name'        => $guildData['name'],
                'description' => $guildData['description'],
                'visibility'  => $guildData['visibility'],
                'teacher_id'  => $gm->id,
                // Explicitly set join_code because WithoutModelEvents (used in
                // DatabaseSeeder) suppresses the booted() hook that normally
                // auto-generates this value.
                'join_code'   => strtoupper(Str::random(6)),
            ]);
        }
        return $classrooms;
    }

    // ─────────────────────────────────────────────────────────────
    //  HELPER: Create quests for a subject (with material + quizzes)
    // ─────────────────────────────────────────────────────────────
    private function createQuestsForSubject(Subject $subject, int $guildIndex, int $subjectIndex): void
    {
        $prefixes = $this->questTemplates['prefixes'];
        $objects  = $this->questTemplates['objects'];

        // 2–4 quests per subject
        $questCount = ($subjectIndex % 2 === 0) ? 4 : 3;
        // Shuffle to vary quest titles
        shuffle($prefixes);
        shuffle($objects);

        for ($order = 1; $order <= $questCount; $order++) {
            $prefix = $prefixes[($order - 1) % count($prefixes)];
            $object = $objects[($order - 1) % count($objects)];

            $quest = Quest::create([
                'title'       => "{$prefix} {$object}",
                'description' => "A perilous challenge awaits within this quest. Gather your knowledge and prepare to {$prefix} {$object}. Only the studious will claim the XP reward.",
                'order'       => $order,
                'xp_reward'   => 50 * $order,  // 50, 100, 150, 200
                'subject_id'  => $subject->id,
            ]);

            // Attach a Material to quests 1, 2, and 4 (skip 3 for variety)
            if ($order !== 3) {
                $this->createMaterialAndQuizzes($quest, $guildIndex);
            }
        }
    }

    // ─────────────────────────────────────────────────────────────
    //  HELPER: Create Material + Quizzes for a Quest
    // ─────────────────────────────────────────────────────────────
    private function createMaterialAndQuizzes(Quest $quest, int $guildIndex): void
    {
        $materialTemplate = $this->materialTemplates[$quest->order % count($this->materialTemplates)];
        $quizSet          = $this->quizSets[$guildIndex % count($this->quizSets)];

        $material = Material::create([
            'title'     => $materialTemplate['title'] . ' — ' . $quest->title,
            'content'   => $materialTemplate['content'],
            'video_url' => $materialTemplate['video_url'],
            'quest_id'  => $quest->id,
        ]);

        // Attach 2–3 quiz questions per material
        $quizCount = min(count($quizSet), ($quest->order >= 3) ? 3 : 2);
        for ($i = 0; $i < $quizCount; $i++) {
            $q = $quizSet[$i % count($quizSet)];
            Quiz::create([
                'question'       => $q['question'],
                'option_a'       => $q['a'],
                'option_b'       => $q['b'],
                'option_c'       => $q['c'],
                'option_d'       => $q['d'],
                'correct_answer' => $q['correct'],
                'material_id'    => $material->id,
            ]);
        }
    }
}
