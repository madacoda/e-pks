<?php

use App\Models\Pks03Supervision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can add supervision record to user', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create(['role' => 'pidana']);

    $this->actingAs($admin)
        ->post("/admin/users/{$pidana->id}/supervisions", [
            'supervision_date' => now()->format('Y-m-d'),
            'supervision_type' => 'Reguler',
            'notes' => 'Terpidana sangat patuh.',
            'behavior_status' => 'Sangat Baik',
            'compliance_status' => 'Patuh',
        ])
        ->assertRedirect();

    expect($pidana->supervisions()->count())->toBe(1);
    expect($pidana->supervisions()->first()->supervision_type)->toBe('Reguler');
});

test('latest supervision status is shown on convict dashboard', function () {
    $pidana = User::factory()->create(['role' => 'pidana']);

    Pks03Supervision::create([
        'user_id' => $pidana->id,
        'supervision_date' => now(),
        'supervision_type' => 'Reguler',
        'compliance_status' => 'Patuh',
        'behavior_status' => 'Baik',
        'notes' => 'Test note',
    ]);

    $this->actingAs($pidana)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('Status Pengawasan PKS-03')
        ->assertSee('Patuh')
        ->assertSee('Baik');
});

test('convict cannot add supervision record', function () {
    $pidana = User::factory()->create(['role' => 'pidana']);
    $otherPidana = User::factory()->create(['role' => 'pidana']);

    $this->actingAs($pidana)
        ->post("/admin/users/{$otherPidana->id}/supervisions", [
            'supervision_date' => now()->format('Y-m-d'),
            'supervision_type' => 'Reguler',
            'compliance_status' => 'Patuh',
        ])
        ->assertForbidden();
});

test('admin can access supervision index and update record', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create(['role' => 'pidana']);

    $supervision = Pks03Supervision::create([
        'user_id' => $pidana->id,
        'supervision_date' => now(),
        'supervision_type' => 'Reguler',
        'compliance_status' => 'Patuh',
        'behavior_status' => 'Baik',
    ]);

    $this->actingAs($admin)
        ->get("/admin/users/{$pidana->id}/supervisions")
        ->assertSuccessful()
        ->assertSee('Tambah Pengawasan')
        ->assertSee('Reguler');

    $this->actingAs($admin)
        ->put("/admin/supervisions/{$supervision->id}", [
            'supervision_date' => now()->format('Y-m-d'),
            'supervision_type' => 'Evaluasi',
            'compliance_status' => 'Peringatan 1',
        ])
        ->assertRedirect();

    expect($supervision->fresh()->supervision_type)->toBe('Evaluasi');
    expect($supervision->fresh()->compliance_status)->toBe('Peringatan 1');
});
