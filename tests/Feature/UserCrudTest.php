<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create();
});

test('guest cannot access user pages', function () {
    $this->get(route('users.index'))
        ->assertRedirect(route('login'));
});

test('user list page can be loaded', function () {
    $this->actingAs($this->admin)
        ->get(route('users.index'))
        ->assertStatus(200);
});

test('user can be created', function () {
    $this->actingAs($this->admin)
        ->post(route('users.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
});

test('user creation requires email', function () {
    $this->actingAs($this->admin)
        ->post(route('users.store'), [
            'name' => 'Test User',
            'password' => 'password',
        ])
        ->assertSessionHasErrors(['email']);
});

test('user email must be unique on create', function () {
    User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $this->actingAs($this->admin)
        ->post(route('users.store'), [
            'name' => 'Another User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->assertSessionHasErrors(['email']);
});

test('user edit page can be loaded', function () {
    $user = User::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('users.edit', $user))
        ->assertStatus(200);
});

test('user can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($this->admin)
        ->put(route('users.update', $user), [
            'name' => 'Updated Name',
            'email' => $user->email,
        ])
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
    ]);
});

test('user can keep same email while updating', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $this->actingAs($this->admin)
        ->put(route('users.update', $user), [
            'name' => 'Updated Name',
            'email' => 'test@example.com',
        ])
        ->assertSessionHasNoErrors();
});

test('user email must be unique on update', function () {
    User::factory()->create([
        'email' => 'first@example.com',
    ]);

    $user = User::factory()->create([
        'email' => 'second@example.com',
    ]);

    $this->actingAs($this->admin)
        ->put(route('users.update', $user), [
            'name' => 'Updated Name',
            'email' => 'first@example.com',
        ])
        ->assertSessionHasErrors(['email']);
});

test('user can be deleted', function () {
    $user = User::factory()->create();

    $this->actingAs($this->admin)
        ->delete(route('users.destroy', $user))
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});
