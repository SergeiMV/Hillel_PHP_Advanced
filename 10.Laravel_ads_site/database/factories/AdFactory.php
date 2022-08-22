<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->realText(rand(10, 20)),
            'description' => $this->faker->realText(rand(30, 100)),
            'author_id' => User::factory(),
            'author_name' => $this->faker->firstName(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
