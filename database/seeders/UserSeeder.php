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
            ],
            [
                'name' => 'Ajirung Katos',
                'email' => 'pidana2@madacoda.dev',
                'password' => Hash::make('Pidana123'),
                'role' => 'pidana',
                'date_of_birth' => '1985-10-20',
                'crime' => 'Penganiayaan Ringan (352 KUHP)',
            ],
            [
                'name' => 'Afithor Subaha',
                'email' => 'pidana3@madacoda.dev',
                'password' => Hash::make('Pidana123'),
                'role' => 'pidana',
                'date_of_birth' => '1995-02-10',
                'crime' => 'Kerusakan Barang (406 KUHP)',
            ],
            [
                'name' => 'Admin Kejaksaan',
                'email' => 'admin@kejaksaan.go.id',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'date_of_birth' => '1980-01-01',
                'crime' => null,
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
