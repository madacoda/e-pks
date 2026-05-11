<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Placement;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $placements = Placement::all();

        if ($placements->isEmpty()) {
            $this->command->warn('No Placements found. Please run PlacementSeeder first.');

            return;
        }

        foreach ($placements as $placement) {
            // Create 3 locations for each placement
            for ($i = 1; $i <= 3; $i++) {
                // Determine a slight offset for latitude/longitude so they aren't exactly the same
                // Approximate 1km = 0.009 degrees
                $latOffset = (rand(-10, 10) / 1000);
                $lngOffset = (rand(-10, 10) / 1000);

                // Base coordinates (Surabaya region approx)
                $baseLat = -7.250445;
                $baseLng = 112.768845;

                Location::create([
                    'placement_id' => $placement->id,
                    'name' => 'Panti Asuhan '.['Harapan', 'Kasih', 'Bunda', 'Bakti', 'Sejahtera'][rand(0, 4)].' '.$i,
                    'address' => 'Jl. Contoh Alamat Baksos No. '.rand(1, 100),
                    'latitude' => $baseLat + $latOffset,
                    'longitude' => $baseLng + $lngOffset,
                    'phone' => '0812345678'.rand(10, 99),
                    'pic_name' => 'Bapak / Ibu PIC '.$i,
                ]);
            }
        }
    }
}
