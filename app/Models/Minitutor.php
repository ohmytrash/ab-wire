<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Minitutor extends Model
{

    const EDUCATION_LEVELS = ['D1', 'D2', 'D3', 'S1', 'S2', 'S3'];

    protected $fillable = [
        'user_id',
        'last_education_level',
        'last_education_campus',
        'last_education_location',
        'last_education_majors',
        'active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Post::class);
    }
}
