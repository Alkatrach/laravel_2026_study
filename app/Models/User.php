<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function turtles(): HasMany
    {
        return $this->hasMany(Turtle::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')->withTimestamps();
    }

    public function isFriendWith(User $user): bool
    {
        return $this->friends()->whereKey($user->id)->exists();
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }
}
