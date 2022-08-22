<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->unique()->password()),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
