<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can assign jaksa to pidana', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $jaksa = User::factory()->create(['role' => 'jaksa_pengawas']);
    $pidana = User::factory()->create(['role' => 'pidana', 'email' => 'pidana@example.com']);

    $response = $this->actingAs($admin)
        ->put("/admin/users/{$pidana->id}", [
            'name' => $pidana->name,
            'email' => $pidana->email,
            'role' => 'pidana',
            'placement_id' => Placement::factory()->create()->id,
            'jaksa_ids' => [$jaksa->id],
        ]);

    $response->assertStatus(302);
    expect($pidana->assignedJaksa()->count())->toBe(1);
    expect($pidana->assignedJaksa()->first()->id)->toBe($jaksa->id);
});
