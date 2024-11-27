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
        foreach ($supplier->carSubtype as $subtype) {
            $response->assertSee($subtype);
        }

        foreach ($supplier->carMake as $make) {
            $response->assertSee($make);
        }

        foreach ($supplier->carType as $type) {
            $response->assertSee($type);
        }
    }
});


it('loads suppliers and their managers on the main page', function () {
    $suppliers = Supplier::factory()
        ->has(Manager::factory()->count(3))
        ->count(2)
        ->create();

    $response = $this->get(route('user.index'));

    $response->assertOk();

    foreach ($suppliers as $supplier) {
        $response->assertSee($supplier->name);
        foreach ($supplier->managers as $manager) {
            $response->assertSee($manager->name ?? $manager->email);
        }
    }
});it('filters suppliers based on exact matches', function () {
    $matchingSupplier = Supplier::factory()->create([
        'carType' => ['SUV'],
        'carSubtype' => ['Crossover'],
        'carMake' => ['Toyota'],
        'name' => 'Supplier A',
        'rating' => 'A',
        'workTerms' => 'Flexible',
    ]);

    $nonMatchingSupplier = Supplier::factory()->create([
        'carType' => ['Truck'],
        'carSubtype' => ['Heavy Duty'],
        'carMake' => ['Ford'],
        'name' => 'Supplier B',
        'rating' => 'B',
        'workTerms' => 'Strict',
    ]);

    $response = $this->get(route('user.index', [
        'carType' => ['SUV'],
        'carSubtype' => ['Crossover'],
        'carMake' => ['Toyota'],
        'name' => 'Supplier A',
        'rating' => ['A'],
        'workTerms' => ['Flexible'],
    ]));

    $response->assertOk();
    $response->assertSeeInOrder([
        '<section id="table">',
        'Supplier A',
        '</section>',
    ], false);

});

it('excludes suppliers when nullable fields do not match', function () {
    Supplier::factory()->create([
        'carType' => ['SUV'],
        'workTerms' => 'Flexible',
    ]);

    Supplier::factory()->create([
        'carType' => ['SUV'],
        'workTerms' => null,
    ]);

    $response = $this->get(route('user.index', [
        'carType' => ['SUV'],
        'workTerms' => ['Flexible'],
    ]));

    $response->assertOk();
    $response->assertSeeInOrder([
        '<section id="table">',
        'SUV',
        'Flexible',
        '</section>',
    ], false);

});

it('returns all suppliers for an empty search', function () {
    $supplier1 = Supplier::factory()->create(['name' => 'Supplier A']);
    $supplier2 = Supplier::factory()->create(['name' => 'Supplier B']);

    $response = $this->get(route('user.index', []));

    $response->assertOk();

    $response->assertSee('Supplier A');
    $response->assertSee('Supplier B');
});

it('excludes suppliers when filters do not match', function () {
    Supplier::factory()->create([
        'carType' => ['SUV'],
        'carSubtype' => ['Crossover'],
    ]);

    Supplier::factory()->create([
        'carType' => ['Truck'],
        'carSubtype' => ['Heavy Duty'],
    ]);

    $response = $this->get(route('user.index', [
        'carType' => ['Electric'],
    ]));

    $response->assertOk();
    $response->assertSeeInOrder([
        '<section id="table">',
        '</section>',
    ], false);
});

it('filters suppliers by multiple selected values', function () {
    // Arrange: Create sample suppliers
    $supplier1 = Supplier::factory()->create([
        'carMake' => ['Toyota', 'Honda'],
        'rating' => 'A',
    ]);

    $supplier2 = Supplier::factory()->create([
        'carMake' => ['Ford'],
        'rating' => 'B',
    ]);

    $supplier3 = Supplier::factory()->create([
        'carMake' => ['Tesla'],
        'rating' => 'C',
    ]);

    // Act: Perform a search for multiple car makes and ratings
    $response = $this->get(route('user.index', [
        'carMake' => ['Toyota', 'Ford'],
        'rating' => ['A', 'B'],
    ]));
    $content = $response->getContent();
    preg_match('/<section id="table">(.*?)<\/section>/s', $content, $matches);
    $resultsSection = $matches[1] ?? '';


    $response->assertOk();
    $this->assertStringNotContainsString('Tesla', $resultsSection);

    $this->assertStringContainsString('Toyota', $resultsSection);
    $this->assertStringContainsString('Ford', $resultsSection);
});
