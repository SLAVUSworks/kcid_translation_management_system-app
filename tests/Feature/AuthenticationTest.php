<?php

use App\Models\User;

it('registers a new user with unverified role', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertRedirect(route('dashboard'));
    expect(User::where('email', 'test@example.com')->first())
        ->not->toBeNull()
        ->role->toEqual('unverified');
});

it('login works for all roles', function () {
    $user = User::factory()->create([
        'role' => 'verified',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
});

it('displays login page correctly', function () {
    $response = $this->get('/login');

    $response->assertSuccessful()->assertViewIs('auth.login');
});

it('displays register page correctly', function () {
    $response = $this->get('/register');

    $response->assertSuccessful()->assertViewIs('auth.register');
});

it('validates registration email uniqueness', function () {
    User::factory()->create([
        'email' => 'duplicate@example.com',
    ]);

    $response = $this->post('/register', [
        'name' => 'Another User',
        'email' => 'duplicate@example.com',
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertSessionHasErrors('email');
});
