<?php

use App\Models\User;

it('redirects unverified users to restricted dashboard', function () {
    $user = User::factory()->create(['role' => 'unverified']);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertSuccessful()->assertViewIs('dashboard.restricted');
});

it('redirects verified users to main dashboard', function () {
    $user = User::factory()->create(['role' => 'verified']);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertSuccessful();
});

it('redirects admin users to main dashboard', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertSuccessful();
});

it('prevents unauthenticated users from accessing dashboard', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
