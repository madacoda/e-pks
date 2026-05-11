<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Placement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'placement_id' => Placement::factory(),
            'name' => fake()->company(),
            'address' => fake()->address(),
            'pic_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'latitude' => fake()->latitude(-10, 10),
            'longitude' => fake()->longitude(90, 140),
        ];
    }
}
