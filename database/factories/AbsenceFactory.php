<?php

namespace Database\Factories;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'pidana')->inRandomOrder()->first()->id ?? User::factory(),
            'image_path' => 'absences/sample.png',
            'latitude' => -6.2 + ($this->faker->numberBetween(-5000, 5000) / 100000),
            'longitude' => 106.8 + ($this->faker->numberBetween(-5000, 5000) / 100000),
            'location_name' => $this->faker->randomElement([
                'Kantor Kelurahan Gambir',
                'Puskesmas Kecamatan Menteng',
                'Dinas Lingkungan Hidup Jakarta',
                'SMAN 1 Jakarta',
                'Taman Suropati',
                'Gedung Serbaguna Senayan'
            ]),
            'status' => 'present',
            'is_flagged' => $this->faker->boolean(10), // 10% chance of radius violation
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
