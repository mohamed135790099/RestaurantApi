<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    public function definition()
    {
        return [
            'title'=>fake()->realText(30,1),
            'menu_id'=>fake()->numberBetween(1,100),
            'image_url'=>fake()->imageUrl(),

        ];
    }
}
