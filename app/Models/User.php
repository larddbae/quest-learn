<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'xp',
        'level',
        'rank',
        'avatar',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Many-to-Many: A user can belong to multiple classrooms (guilds).
     */
    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class)->withTimestamps();
    }

    /**
     * Get the currently active classroom from the session.
     * Returns null if no active classroom is set or the user
     * is not a member of the stored classroom.
     */
    public function activeClassroom(): ?Classroom
    {
        $id = session('active_classroom_id');
        if (!$id) {
            return null;
        }

        return $this->classrooms()->where('classrooms.id', $id)->first();
    }

    /**
     * Classrooms owned/created by this user (teacher role).
     */
    public function ownedClassrooms(): HasMany
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class)->withPivot('awarded_at')->withTimestamps();
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Calculate XP needed for next level.
     * Formula: Target XP = Level * 100 * 1.5
     */
    public function xpForNextLevel(): int
    {
        return (int) ($this->level * 100 * 1.5);
    }

    /**
     * Get XP progress percentage towards next level.
     */
    public function xpProgressPercent(): int
    {
        $needed = $this->xpForNextLevel();
        if ($needed <= 0) return 100;
        return min(100, (int) (($this->xp / $needed) * 100));
    }
}
