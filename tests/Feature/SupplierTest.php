<?php

use App\Models\Manager;
use App\Models\Supplier;

it('loads the suppliers on the index page', function () {
    // Arrange
    $suppliers = Supplier::factory()->count(3)->create();

    // Act: Make a GET request to the index page
    $response = $this->get(route('user.index'));

    // Assert: The response is OK and contains supplier names
    $response->assertOk();

    foreach ($suppliers as $supplier) {
        // Assert individual fields
        $response->assertSee($supplier->name);
        $response->assertSee($supplier->rating);
        $response->assertSee($supplier->workTerms);
        $response->assertSee($supplier->supervisor);

        // Assert array fields
     /*    foreach ($supplier->carSubtype as $subtype) {
            $response->assertSee($subtype);
        }

        foreach ($supplier->carMake as $make) {
            $response->assertSee($make);
        }

        foreach ($supplier->carType as $type) {
            $response->assertSee($type);
        } */
    }
});


it('loads suppliers and their managers on the main page', function () {
    // Arrange: Create suppliers with managers
    $suppliers = Supplier::factory()
        ->has(Manager::factory()->count(3)) // Each supplier has 3 managers
        ->count(2)
        ->create();

    // Act: Load the main page
    $response = $this->get(route('user.index')); // Replace 'main.page' with your actual route name

    // Assert: Suppliers and their managers are eager-loaded and visible
    $response->assertOk();

    foreach ($suppliers as $supplier) {
        $response->assertSee($supplier->name); // Assuming suppliers have a 'name' attribute
        foreach ($supplier->managers as $manager) {
            $response->assertSee($manager->name ?? $manager->email); // Check manager visibility
        }
    }
});
