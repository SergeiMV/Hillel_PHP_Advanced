<?php

namespace Database\Factories;

use App\Models\Cards;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriptions>
 */
class SubscriptionsFactory extends Factory
{
    public function definition()
    {
        return [
            'card_id' => Cards::factory(),
            'user_id' => Users::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
        ];
    }
}
