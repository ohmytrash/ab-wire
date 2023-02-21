<?php

namespace App\Models;

use App\Helpers\AvatarHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'website',
        'email_notification',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function joinMinitutor(): HasOne
    {
        return $this->hasOne(JoinMinitutor::class);
    }

    public function minitutor(): HasOne
    {
        return $this->hasOne(Minitutor::class);
    }

    public function followings(): HasMany
    {
        return $this->hasMany(Follow::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function watches(): HasMany
    {
        return $this->hasMany(Watch::class);
    }

    /**
     * Atributes
     */
    public function getAvatarUrlAttribute(): string
    {
        return AvatarHelper::getUrl($this->avatar);
    }
}
