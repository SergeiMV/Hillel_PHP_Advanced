<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Upvote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(5)->create();
        $users->each(function (User $user) {
            \App\Models\Post::factory(5)->create([
                'author_id' => $user->id,
                'author_name' => $user->username,
                'upvotes_count' => 0,
            ]);
        });

        $posts = \App\Models\Post::all();

        $posts->each(function (Post $post) use ($users) {
            $user = $users->random();
            \App\Models\Comment::factory()->create([
                'post_id' => $post->id,
                'author_id' => $user->id,
                'author_name' => $user->username,
            ]);
        });

        $posts->each(function (Post $post) use ($users) {
            $user = $users->random();
            $upvotes = \App\Models\Upvote::factory()->create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
            $post->upvotes_count++;
            $post->save();
        });
    }
}
