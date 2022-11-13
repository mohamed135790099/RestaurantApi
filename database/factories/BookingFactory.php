<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
         'num_guest'=>fake()->numberBetween(1,20),
         'type_booking'=>fake()->title(),
         'restaurant_id'=>fake()->numberBetween(1,100),
         'user_id'=>fake()->numberBetween(1,100),

        ];
    }
}
