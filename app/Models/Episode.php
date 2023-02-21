<?php

namespace App\Models;

use App\Helpers\VideoHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model
{
    protected $fillable = [
        'lesson_id',
        'name',
        'title',
        'index',
        'seconds'
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function watches(): HasMany
    {
        return $this->hasMany(Watch::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Atributes
     */
    public function getVideoUrlAttribute(): string
    {
        return VideoHelper::getUrl($this->name);
    }
}
