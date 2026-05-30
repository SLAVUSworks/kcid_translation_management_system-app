<?php

use App\Models\User;

it('allows verified users to access admin dashboard', function () {
    $user = User::factory()->create(['role' => 'verified']);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertSuccessful();
});

it('allows admin users to access admin dashboard', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertSuccessful();
});

it('blocks unverified users from accessing admin dashboard', function () {
    $user = User::factory()->create(['role' => 'unverified']);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertForbidden();
});

it('blocks unauthenticated users from accessing admin dashboard', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/login');
});

it('blocks non-admin users from accessing user management', function () {
    $user = User::factory()->create(['role' => 'verified']);

    $response = $this->actingAs($user)->get('/admin/users');

    $response->assertForbidden();
});

it('allows admin users to access user management', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($user)->get('/admin/users');

    $response->assertSuccessful();
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
