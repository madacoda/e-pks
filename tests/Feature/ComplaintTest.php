<?php

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest can submit complaint', function () {
    $this->post('/complaints', [
        'name' => 'John Doe',
        'subject' => 'Masalah Absensi',
        'content' => 'Saya tidak bisa clock in.',
    ])->assertRedirect('/');

    expect(Complaint::count())->toBe(1);
    expect(Complaint::first()->name)->toBe('John Doe');
});

test('admin can see and update complaint status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $complaint = Complaint::create([
        'subject' => 'Test Subject',
        'content' => 'Test Content',
        'status' => 'baru',
    ]);

    $this->actingAs($admin)
        ->get('/admin/complaints')
        ->assertSuccessful()
        ->assertSee('Test Subject');

    $this->actingAs($admin)
        ->put("/admin/complaints/{$complaint->id}", [
            'status' => 'diproses',
        ])
        ->assertRedirect();

    expect($complaint->refresh()->status)->toBe('diproses');
});
