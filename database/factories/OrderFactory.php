<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'unique_id' => Str::random(10),
            'qty' => $this->faker->numberBetween(10, 2000),
            'total' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
