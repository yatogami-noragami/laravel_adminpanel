<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "Electronics", "Fashion and Accessories", "Home and Furniture", "Sports and Outdoors",
            "Garden and Tools", "Craftsmanship and Handmade", "Business and Industrial", "Education and Learning"
        ];

        $states = ['publish', 'unpublish'];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'status' => $this->faker->randomElement($states)
        ];
    }
}
