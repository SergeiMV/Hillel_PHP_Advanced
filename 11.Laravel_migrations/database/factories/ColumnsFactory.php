<?php

namespace Database\Factories;

use App\Models\Boards;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Columns>
 */
class ColumnsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'order' => $this->faker->randomDigit(),
            'board_id' => Boards::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
        ];
    }
}
