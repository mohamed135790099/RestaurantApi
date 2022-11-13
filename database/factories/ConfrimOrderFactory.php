<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\confrimorder>
 */
class ConfrimOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'user_name'=>fake()->userName(),
           'phone'=>fake()->phoneNumber(),
           'location'=>fake()->address(),
           'order_id'=>fake()->numberBetween(1,100),
           'user_id'=>fake()->numberBetween(1,100),
        ];
    }
}
