<?php

use App\Models\Pks03SupportAssessment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can view pks03 assessment page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.pks03-assessment.show', $pidana));

    $response->assertStatus(200);
    $response->assertViewIs('admin.users.pks03-assessment');
});

test('non-admin cannot view pks03 assessment page', function () {
    $user = User::factory()->create();
    $pidana = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.pks03-assessment.show', $pidana));

    $response->assertForbidden();
});

test('admin can create pks03 assessment with institutions', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create();

    $data = [
        'assessed_by' => 'Jaksa Agung',
        'assessed_at' => now()->format('Y-m-d'),
        'bapas_available' => 1,
        'bapas_institution_name' => 'BAPAS Jakarta',
        'guidance_program_available' => 1,
        'conclusion' => 'tersedia_memadai',
        'notes' => 'Catatan tes',
        'institutions' => [
            [
                'institution_name' => 'RSUD Kota',
                'service_type' => 'rumah_sakit',
                'address_contact' => 'Jl. RSUD No. 1',
                'is_available' => 1,
            ],
            [
                'institution_name' => 'Panti Sosial Asih',
                'service_type' => 'panti_asuhan',
                'address_contact' => 'Jl. Panti No. 2',
                'is_available' => 0,
            ],
        ],
    ];

    $response = $this->actingAs($admin)->post(route('admin.pks03-assessment.store', $pidana), $data);

    $response->assertRedirect(route('admin.pks03-assessment.show', $pidana));

    $this->assertDatabaseHas('pks03_support_assessments', [
        'user_id' => $pidana->id,
        'assessed_by' => 'Jaksa Agung',
        'conclusion' => 'tersedia_memadai',
    ]);

    $this->assertDatabaseHas('pks03_support_institutions', [
        'institution_name' => 'RSUD Kota',
        'is_available' => 1,
    ]);

    $this->assertDatabaseHas('pks03_support_institutions', [
        'institution_name' => 'Panti Sosial Asih',
        'is_available' => 0,
    ]);
});

test('validation requires conclusion', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create();

    $data = [
        'assessed_by' => 'Jaksa Agung',
        'assessed_at' => now()->format('Y-m-d'),
    ];

    $response = $this->actingAs($admin)->post(route('admin.pks03-assessment.store', $pidana), $data);

    $response->assertSessionHasErrors('conclusion');
});

test('admin can update pks03 assessment and replace institutions', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $pidana = User::factory()->create();

    $assessment = Pks03SupportAssessment::create([
        'user_id' => $pidana->id,
        'assessed_by' => 'Jaksa Lama',
        'assessed_at' => now()->format('Y-m-d'),
        'conclusion' => 'tidak_tersedia',
    ]);

    $assessment->institutions()->create([
        'institution_name' => 'RS Lama',
        'service_type' => 'rumah_sakit',
        'is_available' => true,
    ]);

    $data = [
        'assessed_by' => 'Jaksa Baru',
        'assessed_at' => now()->format('Y-m-d'),
        'bapas_available' => 0,
        'conclusion' => 'tersedia_terbatas',
        'institutions' => [
            [
                'institution_name' => 'RS Baru',
                'service_type' => 'rumah_sakit',
                'address_contact' => 'Jl. Baru',
                'is_available' => 1,
            ],
        ],
    ];

    $response = $this->actingAs($admin)->put(route('admin.pks03-assessment.update', $pidana), $data);

    $response->assertRedirect(route('admin.pks03-assessment.show', $pidana));

    $this->assertDatabaseHas('pks03_support_assessments', [
        'id' => $assessment->id,
        'assessed_by' => 'Jaksa Baru',
        'conclusion' => 'tersedia_terbatas',
    ]);

    // RS Lama should be deleted
    $this->assertDatabaseMissing('pks03_support_institutions', [
        'institution_name' => 'RS Lama',
    ]);

    // RS Baru should be added
    $this->assertDatabaseHas('pks03_support_institutions', [
        'institution_name' => 'RS Baru',
    ]);
});
