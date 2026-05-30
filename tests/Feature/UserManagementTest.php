<?php

use App\Models\User;

it('displays user list for admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    User::factory()->count(3)->create();

    $response = $this->actingAs($admin)->get('/admin/users');

    $response->assertSuccessful();
});

it('search users by name', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['name' => 'John Doe']);

    $response = $this->actingAs($admin)->get('/admin/users?search=John');

    $response->assertSuccessful();
});

it('search users by email', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['email' => 'john@example.com']);

    $response = $this->actingAs($admin)->get('/admin/users?search=john@example.com');

    $response->assertSuccessful();
});

it('allows admin to update user role to verified', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'unverified']);

    $response = $this->actingAs($admin)->patch("/admin/users/{$user->id}/role", [
        'role' => 'verified',
    ]);

    $response->assertRedirect(route('users.index'));
    expect($user->fresh()->role)->toEqual('verified');
});

it('allows admin to update user role to admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'verified']);

    $response = $this->actingAs($admin)->patch("/admin/users/{$user->id}/role", [
        'role' => 'admin',
    ]);

    $response->assertRedirect(route('users.index'));
    expect($user->fresh()->role)->toEqual('admin');
});

it('blocks non-admin from updating user roles', function () {
    $user = User::factory()->create(['role' => 'verified']);
    $target = User::factory()->create(['role' => 'unverified']);

    $response = $this->actingAs($user)->patch("/admin/users/{$target->id}/role", [
        'role' => 'verified',
    ]);

    $response->assertForbidden();
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
