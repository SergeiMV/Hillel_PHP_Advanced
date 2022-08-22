<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Boards;
use App\Models\Columns;
use App\Models\Cards;
use App\Models\Comments;
use App\Models\Subscriptions;
use App\Models\Notifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        \App\Models\Users::factory(2)->create();
        $users = Users::all();

        $users->each(function(Users $user){
            \App\Models\Boards::factory(1)->create(['author_id' => $user->id]);
        });

        $boards = Boards::all();
        $boards->each(function (Boards $board) use ($users) {
            $board->users()->attach($users->random());
            \App\Models\Columns::factory(2)->create(['board_id' => $board->id]);
        });

        $columns = Columns::all();
        $columns->each(function (Columns $column) use ($users, $boards) {
            \App\Models\Cards::factory(2)->create([
                'column_id' => $column->id,
                'author_id' => $users->random(),
                'executor_id' => $users->random(),
            ]);
        });

        $cards = Cards::all();
        $cards->each(function (Cards $card) use ($users) {
            \App\Models\Comments::factory(1)->create([
                'card_id' => $card->id,
                'user_id' => $users->random()
            ]);
            \App\Models\Subscriptions::factory(1)->create([
                'card_id' => $card->id,
                'user_id' => $users->random()
            ]);
            \App\Models\Notifications::factory(1)->create(['card_id' => $card->id]); 
        });

        Notifications::all()->each(function (Notifications $notification) use ($cards) {
            $notification->subscriptions()->attach(Subscriptions::all()->random(), ['viewied_at' => now()]);
        });
    }
}
