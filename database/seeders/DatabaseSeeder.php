<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\Manager;
use App\Models\ManagerReview;
use App\Models\Supplier;
use App\Models\SupplierReview;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the user
        $user = User::factory()->create([
            'name' => 'user',
            'image' => collect(glob(storage_path('app/public/avatars/*.*')))
                ->map(fn($path) => 'avatars/' . basename($path))
                ->random(),
            'role' => UserRole::User->value,
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
        ]);

        User::factory()->create([
            'name' => 'admin',
            'role' => UserRole::Admin->value,
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        User::factory()->create([
            'name' => 'editor',
            'role' => UserRole::Editor->value,
            'email' => 'editor@example.com',
            'password' => Hash::make('editor123'),
        ]);


        Supplier::factory(80)
            ->has(
                Manager::factory(5)
                    ->has(
                        ManagerReview::factory(1)
                            ->state([
                                'user_id' => $user->id,
                            ])
                    )
            )
            ->has(
                SupplierReview::factory(10)
                    ->state([
                        'user_id' => $user->id,
                    ])
            )
            ->create();


        $this->call(CriteriaSeeder::class);
        $this->command->info('Database seeded successfully!');
    }
}
