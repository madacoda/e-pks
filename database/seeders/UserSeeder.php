<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'pidana1@madacoda.dev',
                'password' => Hash::make('Pidana123'),
                'role' => 'pidana',
                'date_of_birth' => '1990-05-15',
                'crime' => 'Pencurian Ringan (364 KUHP)',
                'placement' => 'Kejari Jakarta Pusat',
                'sentence' => '180 Hari Kerja Sosial di SMAN 2 Jakarta Selatan',
            ],
            [
                'name' => 'Ajirung Katos',
                'email' => 'pidana2@madacoda.dev',
                'password' => Hash::make('Pidana123'),
                'role' => 'pidana',
                'date_of_birth' => '1985-10-20',
                'crime' => 'Penganiayaan Ringan (352 KUHP)',
                'placement' => 'Kejari Bandung',
                'sentence' => '90 Hari Kerja Sosial di SD Kristen Bina Kasih Bandung',
            ],
            [
                'name' => 'Afithor Subaha',
                'email' => 'pidana3@madacoda.dev',
                'password' => Hash::make('Pidana123'),
                'role' => 'pidana',
                'date_of_birth' => '1995-02-10',
                'crime' => 'Kerusakan Barang (406 KUHP)',
                'placement' => 'Kejari Surabaya',
                'sentence' => '360 Hari Kerja Sosial di SMP Negeri 8 Surabaya',
            ],
            [
                'name' => 'Admin Kejaksaan',
                'email' => 'admin@kejaksaan.go.id',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'date_of_birth' => '1980-01-01',
                'crime' => null,
                'placement' => null,
                'sentence' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
