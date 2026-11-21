<?php

// Pendaftaran mandiri dinonaktifkan; akun dibuat oleh admin melalui menu User.

test('registration screen is not available', function () {
    $this->get('/register')->assertNotFound();
});

test('guests cannot register', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertNotFound();

    $this->assertGuest();
});
