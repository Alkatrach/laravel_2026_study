<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Turtle;
use App\Models\User;
use Illuminate\Database\Seeder;

class RelationsSeeder extends Seeder
{
    public function run(): void
    {
        $ivan = User::where('username', 'ivan')->first();
        $maria = User::where('username', 'maria')->first();
        $admin = User::where('username', 'admin')->first();

        if (! $ivan || ! $maria || ! $admin) {
            return;
        }

        Friendship::firstOrCreate(['user_id' => $ivan->id, 'friend_id' => $maria->id]);

        $turtles = Turtle::orderBy('id')->take(3)->get();

        $comments = [
            [$maria, 'Красивая черепаха!'],
            [$admin, 'Очень интересный факт.'],
            [$ivan, 'Согласен, отличная карточка.'],
        ];

        foreach ($turtles as $index => $turtle) {
            [$author, $body] = $comments[$index % count($comments)];
            $turtle->comments()->create(['user_id' => $author->id, 'body' => $body]);
        }
    }
}
