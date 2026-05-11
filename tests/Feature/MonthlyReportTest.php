<?php

use App\Models\Absence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can view monthly report', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana']);

    Absence::create([
        'user_id' => $user->id,
        'status' => 'hadir',
        'latitude' => 0,
        'longitude' => 0,
        'image_path' => 'test.jpg',
        'created_at' => now(),
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.reports.monthly', $user));

    $response->assertStatus(200);
    $response->assertSee($user->name);
    $response->assertSee('Rekapitulasi Kehadiran');
});

test('admin can export monthly report pdf', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana']);

    $response = $this->actingAs($admin)
        ->get(route('admin.export.monthly', $user));

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
});
