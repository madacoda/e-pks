<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('complaint submission is throttled', function () {
    // We set throttle to 30,1 in web.php for POST /complaints
    // Let's test it by hitting it 31 times

    for ($i = 0; $i < 30; $i++) {
        $this->post('/complaints', [
            'subject' => 'Test',
            'content' => 'Test content',
        ])->assertStatus(302); // Redirect to home
    }

    $this->post('/complaints', [
        'subject' => 'Test 31',
        'content' => 'Test content',
    ])->assertStatus(429);
});

test('complaint create page is throttled', function () {
    // We set throttle to 60,1 in web.php for GET /complaints/create

    for ($i = 0; $i < 60; $i++) {
        $this->get('/complaints/create')->assertStatus(200);
    }

    $this->get('/complaints/create')->assertStatus(429);
});
