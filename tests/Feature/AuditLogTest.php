<?php

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin action creates audit record', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana', 'name' => 'Original Name', 'email' => 'test@example.com']);

    $response = $this->actingAs($admin)
        ->put("/admin/users/{$user->id}", [
            'name' => 'Changed Name',
            'email' => $user->email,
            'role' => 'pidana'
        ]);

    $response->assertStatus(302);
    expect(AuditLog::count())->toBe(1);
    $log = AuditLog::first();
    expect($log->action)->toBe('update_user');
    expect($log->after['name'])->toBe('Changed Name');
});
