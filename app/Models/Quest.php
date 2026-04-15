<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'order',
        'xp_reward',
        'subject_id',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function material(): HasOne
    {
        return $this->hasOne(Material::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    /**
     * Check if this quest is unlocked for a given user.
     * First quest is always unlocked. Subsequent quests require previous quest completion.
     */
    public function isUnlockedFor(User $user): bool
    {
        // First quest in subject is always unlocked
        $previousQuest = Quest::where('subject_id', $this->subject_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();

        if (!$previousQuest) {
            return true;
        }

        return UserProgress::where('user_id', $user->id)
            ->where('quest_id', $previousQuest->id)
            ->where('is_completed', true)
            ->exists();
    }
}
