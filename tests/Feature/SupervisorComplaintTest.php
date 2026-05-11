<?php

use App\Models\SupervisorComplaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->pidana = User::factory()->create(['role' => 'pidana']);
});

it('allows admin to view supervisor complaints index', function () {
    $this->actingAs($this->admin)
        ->get(route('admin.supervisor-complaints.index'))
        ->assertStatus(200);
});

it('does not allow non-admin to view supervisor complaints index', function () {
    $this->actingAs($this->pidana)
        ->get(route('admin.supervisor-complaints.index'))
        ->assertStatus(403);
});

it('allows admin to create a supervisor complaint', function () {
    $data = [
        'supervisor_name' => 'Budi Santoso',
        'pidana_id' => $this->pidana->id,
        'compliance_notes' => 'Terpidana selalu hadir tepat waktu.',
    ];

    $this->actingAs($this->admin)
        ->post(route('admin.supervisor-complaints.store'), $data)
        ->assertRedirect(route('admin.supervisor-complaints.index'));

    $this->assertDatabaseHas('supervisor_complaints', [
        'supervisor_name' => 'Budi Santoso',
        'pidana_id' => $this->pidana->id,
        'compliance_notes' => 'Terpidana selalu hadir tepat waktu.',
    ]);
});

it('allows admin to delete a supervisor complaint', function () {
    $complaint = SupervisorComplaint::create([
        'supervisor_name' => 'Budi Santoso',
        'pidana_id' => $this->pidana->id,
        'compliance_notes' => 'Terpidana selalu hadir tepat waktu.',
    ]);

    $this->actingAs($this->admin)
        ->delete(route('admin.supervisor-complaints.destroy', $complaint))
        ->assertRedirect(route('admin.supervisor-complaints.index'));

    $this->assertDatabaseMissing('supervisor_complaints', [
        'id' => $complaint->id,
    ]);
});
