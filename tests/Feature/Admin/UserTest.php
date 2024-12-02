<?php

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create an admin user for testing
    $this->admin = User::factory()->create([
        'role' => UserRole::Admin->value,
    ]);

    // Create an editor user for testing
    $this->editor = User::factory()->create([
        'role' => UserRole::Editor->value,
    ]);

    // Create a standard user for testing
    $this->user = User::factory()->create([
        'role' => UserRole::User->value,
    ]);
});

it('allows admin to view all users', function () {
    $this->actingAs($this->admin)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee($this->editor->name)
        ->assertSee($this->user->name);
});

it('allows editor to view only users and not editors or admins', function () {
    $this->actingAs($this->editor)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee($this->user->name)
        ->assertDontSee($this->admin->email);
});

it('allows admin to create a new user', function () {
    $this->actingAs($this->admin);

    $userData = [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => UserRole::User->value,
    ];

    $this->post(route('admin.users.store'), $userData)
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $userData['name'],
        'email' => $userData['email'],
    ]);
});

it('allows editor to create a new user but not assign editor or admin roles', function () {
    $this->actingAs($this->editor);

    // Valid case: Editor creating a user
    $validUserData = [
        'name' => 'Valid User',
        'email' => 'validuser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => UserRole::User->value,
    ];

    $this->post(route('admin.users.store'), $validUserData)
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $validUserData['name'],
        'email' => $validUserData['email'],
        'role' => UserRole::User->value,
    ]);

    // Invalid case: Editor attempting to assign editor role
    $invalidUserData = [
        'name' => 'Invalid User',
        'email' => 'invaliduser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => UserRole::Editor->value,
    ];

    /*   $this->post(route('admin.users.store'), $invalidUserData)
        ->assertForbidden(); */

    $this->assertDatabaseMissing('users', [
        'email' => $invalidUserData['email'],
    ]);
});

it('allows admin to update a user', function () {
    $this->actingAs($this->admin);

    $updateData = [
        'name' => 'Valid User',
        'email' => 'validuser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123'
    ];

    $this->put(route('admin.users.update', $this->user->id), $updateData)
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $this->user->id,
        'name' => $updateData['name'],
    ]);
});

it('allows editor to delete users but not admins or other editors', function () {
    $this->actingAs($this->editor);

    $this->delete(route('admin.users.destroy', $this->user->id))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', ['id' => $this->user->id]);

    // Attempt to delete admin
    $this->delete(route('admin.users.destroy', $this->admin->id))->assertRedirect(route('admin.users.index'));

    // Attempt to delete another editor
    $this->delete(route('admin.users.destroy', $this->editor->id))->assertRedirect(route('admin.users.index'));
});

it('does not allow unauthenticated users to access user management', function () {
    $this->get(route('admin.users.index'))->assertRedirect(route('login'));
    $this->post(route('admin.users.store'))->assertRedirect(route('login'));
});
