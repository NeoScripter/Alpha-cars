<?php

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
        $response->assertSee($supplier->id);
        $response->assertSee($supplier->name);
        $response->assertSee($supplier->carType);
        $response->assertSee($supplier->rating);
        $response->assertSee($supplier->workTerms);
        $response->assertSee($supplier->supervisor);

        // Assert array fields
        foreach ($supplier->carSubtype as $subtype) {
            $response->assertSee($subtype);
        }

        foreach ($supplier->carMake as $make) {
            $response->assertSee($make);
        }
    }
});
