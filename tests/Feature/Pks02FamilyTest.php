<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('can update family json fields', function () {
    $familyData = [
        'father_name' => 'Bapak',
        'mother_name' => 'Ibu',
        'family_condition' => 'Harmonis',
    ];

    $data = [
        'name' => 'Terpidana',
        'email' => 'terpidana@example.com',
        'role' => 'pidana',
        'pks02_family_profile' => $familyData,
    ];

    $this->actingAs($this->admin)
        ->put(route('admin.update', $this->pidana), $data)
        ->assertRedirect();

    $user = User::find($this->pidana->id);
    expect($user->pks02_family_profile)->toBe($familyData);
});
