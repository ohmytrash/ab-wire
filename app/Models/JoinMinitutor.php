<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JoinMinitutor extends Model
{
    protected $fillable = [
        'user_id',
        'last_education_level',
        'last_education_campus',
        'last_education_location',
        'last_education_majors',
        'reason',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
