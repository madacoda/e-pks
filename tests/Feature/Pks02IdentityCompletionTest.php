<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can update legal details and sentence hours', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana', 'email' => 'old@example.com']);

    $response = $this->actingAs($admin)
        ->put("/admin/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'role' => 'pidana',
            'pasal' => 'Pasal 362',
            'sub_pasal' => 'Ayat 1',
            'jenis_tindak_pidana' => 'Pencurian',
            'sentence_hours' => 240,
        ]);

    $response->assertStatus(302);
    $user->refresh();
    expect($user->pasal)->toBe('Pasal 362');
    expect($user->sub_pasal)->toBe('Ayat 1');
    expect($user->jenis_tindak_pidana)->toBe('Pencurian');
    expect($user->sentence_hours)->toBe(240);
});
