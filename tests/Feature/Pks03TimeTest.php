<?php

use App\Models\Pks03Supervision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('can create and update supervision with time fields', function () {
    $data = [
        'supervision_date' => '2026-05-11',
        'supervision_type' => 'Reguler',
        'behavior_status' => 'Baik',
        'compliance_status' => 'Patuh',
        'start_time' => '08:00',
        'end_time' => '12:00',
    ];

    $this->actingAs($this->admin)
        ->post(route('admin.supervisions.store', $this->pidana), $data)
        ->assertRedirect();

    $this->assertDatabaseHas('pks03_supervisions', [
        'user_id' => $this->pidana->id,
        'supervision_date' => '2026-05-11 00:00:00',
        'start_time' => '08:00',
        'end_time' => '12:00',
    ]);

    $supervision = Pks03Supervision::where('user_id', $this->pidana->id)->first();

    $updateData = [
        'supervision_date' => '2026-05-11',
        'supervision_type' => 'Reguler',
        'behavior_status' => 'Baik',
        'compliance_status' => 'Patuh',
        'start_time' => '09:00',
        'end_time' => '13:00',
    ];

    $this->actingAs($this->admin)
        ->put(route('admin.supervisions.update', $supervision), $updateData)
        ->assertRedirect();

    $this->assertDatabaseHas('pks03_supervisions', [
        'id' => $supervision->id,
        'start_time' => '09:00',
        'end_time' => '13:00',
    ]);
});
