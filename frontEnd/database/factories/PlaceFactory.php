<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_name' => fake()->city,
            'postcode' => fake()->postcode(),
            'street_name' => fake()->streetAddress,
            'country_id' => fake()->randomElement(Country::all('id')),
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
        ];
    }
}
