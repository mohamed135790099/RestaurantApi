<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price'=>fake()->numberBetween(20,1000),
            'quantity'=>fake()->numberBetween(1,10),
            'meal_id'=>fake()->numberBetween(1,100),
            'restaurant_id'=>fake()->numberBetween(1,100),

        ];
    }
}
