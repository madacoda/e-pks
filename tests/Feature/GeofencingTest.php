<?php

use App\Models\User;
use App\Models\Placement;
use App\Models\Absence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('absence outside 500m radius is flagged', function () {
    Storage::fake('public');
    
    $placement = Placement::factory()->create([
        'latitude' => -6.1754, // Monas
        'longitude' => 106.8272
    ]);
    
    $user = User::factory()->create([
        'role' => 'pidana',
        'placement_id' => $placement->id,
        'email' => 'pidana@example.com'
    ]);

    $response = $this->actingAs($user)
        ->post('/absences', [
            'image' => UploadedFile::fake()->image('selfie.jpg'),
            'latitude' => -6.2088, // ~4km away (Bundaran HI)
            'longitude' => 106.8456,
            'location_name' => 'Outside'
        ]);

    $response->assertStatus(302);
    $absence = Absence::first();
    expect($absence->is_flagged)->toBe(1); // boolean in sqlite/pgsql might be 1
});

test('absence inside 500m radius is NOT flagged', function () {
    Storage::fake('public');
    
    $placement = Placement::factory()->create([
        'latitude' => -6.1754,
        'longitude' => 106.8272
    ]);
    
    $user = User::factory()->create([
        'role' => 'pidana',
        'placement_id' => $placement->id,
        'email' => 'pidana_inside@example.com'
    ]);

    $this->actingAs($user)
        ->post('/absences', [
            'image' => UploadedFile::fake()->image('selfie.jpg'),
            'latitude' => -6.1755, // Very close
            'longitude' => 106.8273,
            'location_name' => 'Inside'
        ]);

    $absence = Absence::latest()->first();
    expect($absence->is_flagged)->toBe(0);
});
