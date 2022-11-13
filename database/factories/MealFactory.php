<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>fake()->realText(40,1),
            'price'=>fake()->numberBetween(100,8000),
            'description'=>fake()->text(400),
            'rate'=>fake()->numberBetween(1,5),
            'review'=>fake()->numberBetween(1,100),
            'image_url'=>fake()->imageUrl(),
            'category_id'=>fake()->numberBetween(1,20),
            
        ];
    }
}
