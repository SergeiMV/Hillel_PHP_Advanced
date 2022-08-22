<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\boards>
 */
class BoardsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
            'author_id' => Users::factory(),
        ];
    }
}
