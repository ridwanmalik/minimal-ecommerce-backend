<?php

namespace Database\Factories;

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
            'qty' => $this->faker->numberBetween(10, 2000),
            'total' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
