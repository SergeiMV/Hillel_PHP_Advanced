<?php

namespace Database\Factories;

use App\Models\Columns;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cards>
 */
class CardsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'column_id' => Columns::factory(),
            'author_id' => Users::factory(),
            'executor_id' => Users::factory(),
            'description' => $this->faker->realText(10),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
        ];
    }
}
