<?php

namespace Database\Factories;

use App\Models\Placement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Placement>
 */
class PlacementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Department',
            'address' => $this->faker->address(),
            'pic_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'latitude' => $this->faker->latitude(-6.3, -6.1),
            'longitude' => $this->faker->longitude(106.7, 106.9),
        ];
    }
}
