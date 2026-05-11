<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('can update background json fields', function () {
    $backgroundData = [
        'last_education' => 'SMA',
        'health_history' => 'Sehat',
    ];

    $data = [
        'name' => 'Terpidana',
        'email' => 'terpidana@example.com',
        'role' => 'pidana',
        'pks02_background' => $backgroundData,
    ];

    $this->actingAs($this->admin)
        ->put(route('admin.update', $this->pidana), $data)
        ->assertRedirect();

    $user = User::find($this->pidana->id);
    expect($user->pks02_background)->toBe($backgroundData);
});
