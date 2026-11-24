<?php

namespace Database\Seeders;

use App\Models\Turtle;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Иван', 'username' => 'ivan', 'email' => 'ivan@example.com'],
            ['name' => 'Мария', 'username' => 'maria', 'email' => 'maria@example.com'],
            ['name' => 'Админ', 'username' => 'admin', 'email' => 'admin@example.com'],
        ];

        $ids = [];
        foreach ($users as $data) {
            $ids[] = User::create($data + ['password' => 'password'])->id;
        }

        $owners = [$ids[0], $ids[0], $ids[1], $ids[1], $ids[2]];

        foreach (Turtle::orderBy('id')->get() as $index => $turtle) {
            Turtle::whereKey($turtle->id)->update(['user_id' => $owners[$index % count($owners)]]);
        }
    }
}
