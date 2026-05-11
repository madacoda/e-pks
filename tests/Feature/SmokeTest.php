<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('landing page is accessible', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Elektronik Pengawasan Kerja Sosial');
});

test('pidana list page is accessible', function () {
    $this->get('/pidana')
        ->assertSuccessful()
        ->assertSeeInOrder(['Monitoring', 'Terpidana']);
});

test('individual pidana profile is accessible', function () {
    $pidana = User::factory()->create(['role' => 'pidana', 'name' => 'John Doe']);

    $this->get("/pidana/{$pidana->id}")
        ->assertSuccessful()
        ->assertSee('John Doe');
});

test('admin can access management panel', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get('/admin/users')
        ->assertSuccessful()
        ->assertSeeInOrder(['Manajemen', 'Database User']);
});

test('non-admin cannot access management panel', function () {
    $pidana = User::factory()->create(['role' => 'pidana']);

    $this->actingAs($pidana)
        ->get('/admin/users')
        ->assertForbidden();
});
