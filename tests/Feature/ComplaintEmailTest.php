<?php

use App\Mail\ComplaintStatusUpdated;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('email is sent when complaint status is updated', function () {
    Mail::fake();

    $admin = User::factory()->create(['role' => 'admin']);
    $complaint = Complaint::create([
        'subject' => 'Test Subject',
        'content' => 'Test Content',
        'email' => 'pelapor@example.com',
        'status' => 'baru',
    ]);

    $this->actingAs($admin)
        ->put("/admin/complaints/{$complaint->id}", [
            'status' => 'diproses',
            'admin_response' => 'Kami sedang memproses laporan Anda.',
        ]);

    Mail::assertSent(ComplaintStatusUpdated::class, function ($mail) use ($complaint) {
        return $mail->hasTo('pelapor@example.com') &&
               $mail->complaint->id === $complaint->id;
    });
});

test('email is not sent if complaint has no email', function () {
    Mail::fake();

    $admin = User::factory()->create(['role' => 'admin']);
    $complaint = Complaint::create([
        'subject' => 'Test Subject',
        'content' => 'Test Content',
        'email' => null,
        'status' => 'baru',
    ]);

    $this->actingAs($admin)
        ->put("/admin/complaints/{$complaint->id}", [
            'status' => 'diproses',
        ]);

    Mail::assertNotSent(ComplaintStatusUpdated::class);
});
