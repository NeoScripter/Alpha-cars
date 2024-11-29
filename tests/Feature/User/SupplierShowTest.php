<?php

use App\Models\Manager;
use App\Models\ManagerReview;
use App\Models\Supplier;
use App\Models\SupplierReview;
use App\Models\User;

it('loads all supplier details on the show page', function () {
    // Arrange: Create a supplier with specific values for testing
    $supplier = Supplier::factory()->create([
        'image' => 'example-image.jpg',
        'name' => 'Test Supplier',
        'stars' => 4.5,
        'website' => 'https://example.com',
        'platform_address' => 'Platform Address Example',
        'unload_address' => 'Unload Address Example',
        'legal_entity' => 'Legal Entity Example',
        'itn' => '1234567890',
        'rrc' => '9876543210',
        'rating' => 'A',
        'workTerms' => 'Flexible',
        'supervisor' => 'John Doe',
        'dkp' => true,
        'image_spec' => false,
        'signees' => 'John Smith',
        'warantees' => true,
        'payWithoutPTC' => false,
        'emails' => ['example1@example.com', 'example2@example.com'],
        'phones' => ['+123456789', '+987654321'],
        'carType' => ['SUV', 'Sedan'],
        'carSubtype' => ['Compact', 'Luxury'],
        'carMake' => ['Toyota', 'Honda'],
    ]);

    // Act: Make a GET request to the supplier's show page
    $response = $this->get(route('user.supplier', $supplier->id));

    // Assert: The response is OK
    $response->assertOk();


    // Assert: Check for individual supplier fields
    $response->assertSee($supplier->image);
    $response->assertSee($supplier->name);
    $response->assertSee($supplier->stars);
    $response->assertSee($supplier->website);
    $response->assertSee($supplier->platform_address);
    $response->assertSee($supplier->unload_address);
    $response->assertSee($supplier->legal_entity);
    $response->assertSee($supplier->itn);
    $response->assertSee($supplier->rrc);
    $response->assertSee($supplier->rating);
    $response->assertSee($supplier->workTerms);
    $response->assertSee($supplier->supervisor);
    $response->assertSee($supplier->dkp ? '1' : '0');
    $response->assertSee($supplier->image_spec ? '1' : '0');
    $response->assertSee($supplier->signees);
    $response->assertSee($supplier->warantees ? '1' : '0');
    $response->assertSee($supplier->payWithoutPTC ? '1' : '0');

    // Assert: Check for array fields
    foreach ($supplier->emails as $email) {
        $response->assertSee($email);
    }

    foreach ($supplier->phones as $phone) {
        $response->assertSee($phone);
    }

    foreach ($supplier->carType as $type) {
        $response->assertSee($type);
    }

    foreach ($supplier->carMake as $make) {
        $response->assertSee($make);
    }
});


it('ensures each manager review contains the necessary information', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'image' => '/images/avatars/test-avatar.png',
    ]);

    $review = ManagerReview::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get(route('user.supplier', $review->manager->supplier_id));

    $response->assertOk();
    $response->assertSee($review->overallStars);
    $response->assertSee($review->content);
    $response->assertSee($review->user->name);
    $response->assertSee($review->user->image);
});


it('displays all manager reviews', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'image' => '/images/avatars/test-avatar.png',
    ]);

    $supplier = Supplier::factory()
        ->has(Manager::factory()
            ->has(ManagerReview::factory()
                ->count(2)
                ->state(['user_id' => $user->id])
            )
        )->create();

    $response = $this->get(route('user.supplier', $supplier->id));

    $response->assertOk();

    foreach ($supplier->managers as $manager) {
        $response->assertSee($manager->name);
        $response->assertSee($manager->image);

        foreach ($manager->managerReviews as $review) {
            $response->assertSee($review->overallStars);
            $response->assertSee($review->content);
            $response->assertSee($review->user->name);
            $response->assertSee($review->user->image);
        }
    }
});


it('displays all supplier reviews', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'image' => '/images/avatars/test-avatar.png',
    ]);

    $supplier = Supplier::factory()
        ->has(SupplierReview::factory()
            ->count(3)
            ->state(['user_id' => $user->id])
        )->create();

    $response = $this->get(route('user.supplier', $supplier->id));

    $response->assertOk();

    foreach ($supplier->supplierReviews as $review) {
        $response->assertSee($review->stars);
        $response->assertSee($review->content);
        $response->assertSee($review->user->name);
        $response->assertSee($review->user->image);
    }
});
