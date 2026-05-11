<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can export pks02 pdf', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $placement = Placement::create(['name' => 'Test Satker']);
    $user = User::factory()->create([
        'role' => 'pidana',
        'placement_id' => $placement->id,
        'pks02_background' => json_encode(['edu_notes' => 'Test']),
        'pks02_family_profile' => json_encode(['father_name' => 'Test Father']),
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.export.pks02', $user));

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
});

test('admin can export pks03 pdf', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana']);

    $response = $this->actingAs($admin)
        ->get(route('admin.export.pks03', $user));

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
});

test('non-admin cannot export pdf', function () {
    $user = User::factory()->create(['role' => 'pidana']);
    $otherUser = User::factory()->create(['role' => 'pidana']);

    $this->actingAs($user)
        ->get(route('admin.export.pks02', $otherUser))
        ->assertStatus(403);
});
