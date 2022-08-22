<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();
        return [
            'title' => $this->faker->realText(rand(10, 50)),
            'link' => $this->faker->url(),
            'author_id' => $user->id,
            'author_name' => $user->username,
            'upvotes_count' => $this->faker->randomDigit(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
