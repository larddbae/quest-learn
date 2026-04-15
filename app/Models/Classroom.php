<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'join_code',
        'teacher_id',
        'description',
    ];

    protected static function booted(): void
    {
        static::creating(function (Classroom $classroom) {
            if (empty($classroom->join_code)) {
                $classroom->join_code = strtoupper(Str::random(6));
            }
        });
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'classroom_id')->where('role', 'student');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
