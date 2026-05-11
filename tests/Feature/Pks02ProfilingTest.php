<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can update user with pks02 profiling data', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create(['role' => 'pidana']);

    $this->actingAs($admin)
        ->put("/admin/users/{$pidana->id}", [
            'name' => 'Updated Name',
            'email' => $pidana->email,
            'role' => 'pidana',
            'placement_id' => Placement::factory()->create()->id,
            'pks02_prosecutor_name' => 'Jaksa Budi',
            'pks02_case_number' => 'PDM-123/JKT/2026',
            'pks02_opinion_analysis' => 'Analisa hukum mendalam.',
            'pks02_opinion_recommendation' => 'Rekomendasi rehabilitasi.',
            'pks02_opinion_conclusion' => 'Kesimpulan akhir.',
        ])
        ->assertRedirect();

    $pidana->refresh();

    expect($pidana->pks02_prosecutor_name)->toBe('Jaksa Budi');
    expect($pidana->pks02_case_number)->toBe('PDM-123/JKT/2026');
});

test('pks02 data is rendered correctly on show page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create([
        'role' => 'pidana',
        'pks02_prosecutor_name' => 'Jaksa Budi',
        'pks02_opinion_analysis' => 'Analisa <strong>Penting</strong>',
    ]);

    $this->actingAs($admin)
        ->get("/pidana/{$pidana->id}")
        ->assertSuccessful()
        ->assertSee('Jaksa Budi')
        ->assertSee('Analisa')
        ->assertSee('Penting');
});
