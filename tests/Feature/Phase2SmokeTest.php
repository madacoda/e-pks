<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('all phase 2 pages load successfully without data leakage', function () {
    $placement = Placement::create(['name' => 'Kejaksaan Negeri Jakarta Selatan']);
    $admin = User::factory()->create(['role' => 'admin', 'placement_id' => $placement->id]);
    $pidana = User::factory()->create([
        'role' => 'pidana',
        'placement_id' => $placement->id,
        'pks02_opinion_analysis' => '<b>HTML</b> content',
    ]);

    $pages = [
        '/',
        '/pidana',
        '/regulations',
        '/complaints/create',
    ];

    foreach ($pages as $url) {
        $this->get($url)->assertSuccessful();
    }

    // Acting as Admin
    $adminPages = [
        '/dashboard',
        '/admin/users',
        "/admin/users/{$pidana->id}/edit",
        '/admin/complaints',
    ];

    foreach ($adminPages as $url) {
        $this->actingAs($admin)
            ->get($url)
            ->assertSuccessful()
            ->assertDontSee('{"id":') // Ensure no raw JSON objects are rendered
            ->assertDontSee('placement_id":');
    }

    // Check relationship rendering
    $this->actingAs($admin)
        ->get('/admin/users')
        ->assertSee('Kejaksaan Negeri Jakarta Selatan');

    // Check HTML rendering for PKS-02
    $this->actingAs($admin)
        ->get("/pidana/{$pidana->id}")
        ->assertSuccessful()
        ->assertSee('HTML'); // Should be visible as text if rendered properly
});
