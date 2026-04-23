<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migrate existing One-to-Many data into the classroom_user pivot table,
     * then drop the classroom_id FK and column from users.
     *
     * WARNING: This is a destructive migration. Back up the database before running.
     */
    public function up(): void
    {
        // Step 1: Copy existing user-classroom relationships to the pivot table.
        // This preserves all existing enrollment data before dropping the column.
        $users = DB::table('users')->whereNotNull('classroom_id')->get();

        foreach ($users as $user) {
            DB::table('classroom_user')->insertOrIgnore([
                'user_id'      => $user->id,
                'classroom_id' => $user->classroom_id,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        // Step 2: Drop the foreign key constraint and the column.
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropColumn('classroom_id');
        });
    }

    /**
     * Reverse: re-add the column (data cannot be fully restored).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->nullOnDelete();
        });

        // Attempt to restore data from the pivot table (takes the first classroom per user)
        $pivotRecords = DB::table('classroom_user')
            ->select('user_id', DB::raw('MIN(classroom_id) as classroom_id'))
            ->groupBy('user_id')
            ->get();

        foreach ($pivotRecords as $record) {
            DB::table('users')
                ->where('id', $record->user_id)
                ->update(['classroom_id' => $record->classroom_id]);
        }
    }
};
