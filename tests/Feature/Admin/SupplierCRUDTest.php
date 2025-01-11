<?php

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create and authenticate a user before each test
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can create a supplier', function () {
    // Use the factory but override the 'image' field with null
    $data = Supplier::factory()->make([
        'image' => null,
    ])->toArray();

    $response = $this->post(route('supplier.create'), $data);

    $response->assertRedirect(route('admin'));

    // Assert the supplier is stored in the database
    $this->assertDatabaseHas('suppliers', [
        'name' => $data['name'],
        'website' => $data['website'],
        'image' => null, // Ensure the image is null
    ]);
});

it('can read a supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->get(route('supplier.edit', $supplier->id));

    $response->assertOk();
    $response->assertSee($supplier->name);
    $response->assertSee($supplier->website);
});

it('can update a supplier', function () {
    $supplier = Supplier::factory()->create();
    $updatedData = [
        'name' => 'Updated Supplier Name',
        'emails' => ['updated@example.com'],
        'phones' => ['123-456-7890'],
        'website' => 'https://updated-website.com',
    ];

    $response = $this->put(route('supplier.update', $supplier->id), $updatedData);

    $response->assertRedirect(route('admin'));
    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Updated Supplier Name',
        'website' => 'https://updated-website.com',
    ]);
});

it('can delete a supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->delete(route('supplier.destroy', $supplier->id));

    $response->assertRedirect(route('admin'));
    $this->assertDatabaseMissing('suppliers', [
        'id' => $supplier->id,
    ]);
});

it('validates input when creating a supplier', function () {
    $response = $this->post(route('supplier.create'), [
        'name' => '',
        'emails' => ['invalid-email'],
        'phones' => ['invalid-phone'],
    ]);

    $response->assertSessionHasErrors([
        'name', 'emails.0', 'phones.0',
    ]);
});
