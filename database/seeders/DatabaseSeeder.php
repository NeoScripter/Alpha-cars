<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Manager;
use App\Models\ManagerReview;
use App\Models\Supplier;
use App\Models\SupplierReview;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the user
        $user = User::factory()->create([
            'name' => 'Dmitry',
            'image' => '/images/avatars/avatar.jpeg',
        ]);

        // Create multiple suppliers
        Supplier::factory(10) // Change the number of suppliers as needed
            ->has(
                // Each supplier has 5 managers
                Manager::factory(5)
                    ->has(
                        // Each manager has 5 reviews
                        ManagerReview::factory(5)
                            ->state([
                                'user_id' => $user->id, // Associate reviews with the created user
                            ])
                    )
            )
            ->has(
                // Each supplier has 40 supplier reviews
                SupplierReview::factory(40)
                    ->state([
                        'user_id' => $user->id, // Associate reviews with the created user
                    ])
            )
            ->create();

        $this->command->info('Database seeded successfully!');
    }
}
