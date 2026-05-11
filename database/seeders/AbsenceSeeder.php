<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pidanaUsers = User::where('role', 'pidana')->get();

        foreach ($pidanaUsers as $user) {
            // Generate 25 random absences for each user over the last month
            // This ensures we have enough for pagination (10 per page)
            for ($i = 0; $i < 25; $i++) {
                Absence::factory()->create([
                    'user_id' => $user->id,
                    // Space them out randomly
                    'created_at' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                ]);
            }
        }
    }
}
