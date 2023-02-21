<?php

namespace App\Models;

use App\Helpers\HeroHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Lesson extends Model
{
    use HasSlug;

    protected $fillable = [
        'minitutor_id',
        'category_id',
        'hero',
        'title',
        'slug',
        'description',
        'public',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function minitutor(): BelongsTo
    {
        return $this->belongsTo(Minitutor::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    /**
     * Atributes
     */
    public function getHeroUrlAttribute()
    {
        return HeroHelper::getUrl($this->hero);
    }

    // Query
    public static function listQuery($model, $publicOnly = true)
    {
        $model->with('minitutor.user')
            ->with('category')
            // ->withCount('comments')
            ->withCount(['episodes as seconds' => function ($q) {
                $q->select(DB::raw('sum(seconds)'));
            }, 'episodes'])
            ->withCount(['reviews as rating' => function ($q) {
                $q->select(DB::raw('coalesce(avg(rating/4),0)'));
            }, 'reviews']);
        if ($publicOnly) {
            $model->where('public', true);
        }

        return $model;
    }
}
