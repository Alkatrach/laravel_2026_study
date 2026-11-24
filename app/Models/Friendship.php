<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['user_id', 'friend_id'];

    protected static function booted(): void
    {
        static::created(function (Friendship $friendship) {
            Friendship::firstOrCreate([
                'user_id' => $friendship->friend_id,
                'friend_id' => $friendship->user_id,
            ]);
        });
    }
}
