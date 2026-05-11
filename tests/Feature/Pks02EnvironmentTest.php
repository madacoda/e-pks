<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('can update environment and daily life json fields', function () {
    $envData = [
        'residential_status' => 'Milik Sendiri',
        'neighborhood_response' => 'Positif',
    ];
    $dailyData = [
        'daily_activities' => 'Bekerja',
        'religious_activities' => 'Rajin',
    ];

    $data = [
        'name' => 'Terpidana',
        'email' => 'terpidana@example.com',
        'role' => 'pidana',
        'placement_id' => Placement::factory()->create()->id,
        'pks02_environment' => $envData,
        'pks02_daily_life' => $dailyData,
    ];

    $this->actingAs($this->admin)
        ->put(route('admin.update', $this->pidana), $data)
        ->assertRedirect();

    $user = User::find($this->pidana->id);
    expect($user->pks02_environment)->toBe($envData);
    expect($user->pks02_daily_life)->toBe($dailyData);
});
