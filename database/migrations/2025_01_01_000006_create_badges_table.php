<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('icon_path')->nullable();
            $table->string('criteria_type'); // e.g., 'quests_completed', 'perfect_score', 'xp_earned'
            $table->integer('criteria_value'); // e.g., 5 (for 5 quests completed)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
