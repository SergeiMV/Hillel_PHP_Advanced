<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = \App\Models\User::factory(3)->create();

        $users->each(function (User $user) {
            \App\Models\Ad::factory(3)->create(['author_id' => $user->id, 'author_name' => $user->username]);
        });
    }
}
