<?php

use App\Models\Manager;
use App\Models\ManagerReview;
use App\Models\Supplier;
use App\Models\User;

it('ensures each manager review contains the necessary information', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'image' => '/images/avatars/test-avatar.png',
    ]);

    $review = ManagerReview::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get(route('user.manager', $review->manager->id));

    $response->assertOk();
    $response->assertSee($review->overallStars);
    $response->assertSee($review->content);
    $response->assertSee($review->user->name);
    $response->assertSee($review->user->image);
});


it('displays all reviews for a single manager', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'image' => '/images/avatars/test-avatar.png',
    ]);

    $supplier = Supplier::factory()
        ->has(Manager::factory()
            ->count(2) // Create 2 managers
            ->has(ManagerReview::factory()
                ->count(2)
                ->state(['user_id' => $user->id])
            )
        )->create();

    $manager = $supplier->managers->first();

    $response = $this->get(route('user.manager', $manager->id));

    $response->assertOk();

    $response->assertSee($manager->name);
    $response->assertSee($manager->image);

    foreach ($manager->managerReviews as $review) {
        $response->assertSee($review->overallStars);
        $response->assertSee($review->content);
        $response->assertSee($review->user->name);
        $response->assertSee($review->user->image);
    }

});
