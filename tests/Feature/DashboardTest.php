<?php

use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected to login', function () {
    $this->get('/dashboard')
        ->assertRedirect('/login');
});

test('admin can see dashboard with correct labels', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'name' => 'Admin User',
    ]);

    $this->actingAs($admin)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('Admin User')
        ->assertSee('PETUGAS KEJAKSAAN');
});

test('pidana can see dashboard with correct labels', function () {
    $pidana = User::factory()->create([
        'role' => 'pidana',
        'name' => 'Pidana User',
    ]);

    $this->actingAs($pidana)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('Pidana User')
        ->assertSee('TERPIDANA KERJA SOSIAL');
});

test('dashboard shows placement name and not json', function () {
    $placement = Placement::create(['name' => 'Kejaksaan Negeri Jakarta Pusat']);

    $user = User::factory()->create([
        'role' => 'pidana',
        'placement_id' => $placement->id,
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('Kejaksaan Negeri Jakarta Pusat')
        ->assertDontSee('{"id":'.$placement->id);
});
