<?php

use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can view settings page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin)->get('/admin/settings')->assertSuccessful();
});

test('non-admin cannot view settings page', function () {
    $pidana = User::factory()->create(['role' => 'pidana']);
    $this->actingAs($pidana)->get('/admin/settings')->assertForbidden();
});

test('admin can update settings', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $this->actingAs($admin)->post('/admin/settings', [
        'regulations_kewajiban' => "Wajib 1\nWajib 2",
        'regulations_larangan' => "Larang 1\nLarang 2",
        'regulations_monitoring' => "Test monitoring",
    ])->assertRedirect(route('admin.settings.index'));

    $this->assertEquals(
        json_encode(['Wajib 1', 'Wajib 2']),
        Setting::get('regulations_kewajiban')
    );
    
    $this->assertEquals(
        'Test monitoring',
        Setting::get('regulations_monitoring')
    );
});
