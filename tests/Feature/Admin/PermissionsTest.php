<?php

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create users with different roles
    $this->user = User::factory()->create(['role' => UserRole::User->value]);
    $this->admin = User::factory()->create(['role' => UserRole::Admin->value]);
    $this->editor = User::factory()->create(['role' => UserRole::Editor->value]);
});

it('allows access to public routes for all roles', function () {
    // User access
    $this->actingAs($this->user)
        ->get(route('user.index'))
        ->assertStatus(200);

    // Admin access
    $this->actingAs($this->admin)
        ->get(route('user.index'))
        ->assertStatus(200);

    // Editor access
    $this->actingAs($this->editor)
        ->get(route('user.index'))
        ->assertStatus(200);
});

it('restricts admin/editor routes from user role', function () {
    $this->actingAs($this->user)
        ->get(route('admin')) // Example admin route
        ->assertStatus(403);

    $this->actingAs($this->user)
        ->get(route('profile.edit')) // Example profile route
        ->assertStatus(403);
});

it('allows admin/editor routes for admin role', function () {
    $this->actingAs($this->admin)
        ->get(route('admin')) // Admin route
        ->assertStatus(200);

    $this->actingAs($this->admin)
        ->get(route('profile.edit')) // Profile route
        ->assertStatus(200);
});

it('allows admin/editor routes for editor role', function () {
    $this->actingAs($this->editor)
        ->get(route('admin')) // Admin route
        ->assertStatus(200);

    $this->actingAs($this->editor)
        ->get(route('profile.edit')) // Profile route
        ->assertStatus(200);
});

it('redirects unauthenticated users to login', function () {
    $this->get(route('user.index'))
        ->assertRedirect(route('login'));

    $this->get(route('admin'))
        ->assertRedirect(route('login'));
});
