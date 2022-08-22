<?php

namespace Database\Factories;

use App\Models\Cards;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifications>
 */
class NotificationsFactory extends Factory
{
    public function definition()
    {
        return [
            'text' => $this->faker->realText(10),
            'card_id' => Cards::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
