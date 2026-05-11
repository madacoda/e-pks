<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('can update work capability json fields', function () {
    $workData = [
        'physical_capability' => 'Mampu Penuh',
        'recommended_work_type' => 'Membersihkan taman',
        'skills' => 'Menyapu, mengecat',
    ];

    $data = [
        'name' => 'Terpidana',
        'email' => 'terpidana@example.com',
        'role' => 'pidana',
        'pks02_work_capability' => $workData,
    ];

    $this->actingAs($this->admin)
        ->put(route('admin.update', $this->pidana), $data)
        ->assertRedirect();

    $user = User::find($this->pidana->id);
    expect($user->pks02_work_capability)->toBe($workData);
});
