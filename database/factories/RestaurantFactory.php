<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'Longitude'=>fake()->longitude(-31.233334,31.2333343),
           'Latitude'=>fake()->latitude(-30.033333,30.033333),
           'rate'=>fake()->numberBetween(1,5),
           'name'=>fake()->company(),
           'title'=>fake()->address(),
           'phone'=>fake()->unique()->phoneNumber(),
           'email'=>fake()->unique()->safeEmail(),
           'description'=>fake()->text(500),
           'image'=>fake()->imageUrl(),
           'menu_id'=>fake()->unique()->numberBetween(1,100),
           'booking_id'=>fake()->numberBetween(1,100),
           'order_id'=>fake()->numberBetween(1,100),

        ];
    }
}
