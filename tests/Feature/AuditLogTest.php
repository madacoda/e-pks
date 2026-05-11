<?php

use App\Models\AuditLog;
use App\Models\Placement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin action creates audit record', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'pidana', 'name' => 'Original Name', 'email' => 'test@example.com']);

    $response = $this->actingAs($admin)
        ->put("/admin/users/{$user->id}", [
            'name' => 'Changed Name',
            'email' => $user->email,
            'role' => 'pidana',
            'placement_id' => Placement::factory()->create()->id,
        ]);

    $response->assertStatus(302);
    expect(AuditLog::count())->toBe(1);
    $log = AuditLog::first();
    expect($log->action)->toBe('update_user');
    expect($log->after['name'])->toBe('Changed Name');
});
