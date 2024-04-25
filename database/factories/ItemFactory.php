<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conditions = ['New', 'Used', 'Good Secondhand'];
        $types = ['For Sell', 'For Buy', 'For Exchange'];
        $states = ['publish', 'unpublish'];
        $countryCodes = ['+93', '+358', '+355', '+213', '+1684', '+376', '+244', '+1264', '+672', '+1268', '+54', '+374', '+297', '+61'];
        return [
            'category_id' => $this->faker->numberBetween($min = 1, $max = 8),
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween($min = 10, $max = 1000),
            'description' => $this->faker->text($maxNbChars = 20),
            'condition' => $this->faker->randomElement($conditions),
            'type' => $this->faker->randomElement($types),
            'status' => $this->faker->randomElement($states),
            'owner_name' => $this->faker->firstName($gender = 'male' | 'female'),
            'country_code' => $this->faker->randomElement($countryCodes),
            'contact_number' => $this->faker->numberBetween($min = 123456789, $max = 554433221),
            'address' => $this->faker->address()
        ];
    }
}
