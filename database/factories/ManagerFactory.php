<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'image' => collect(glob(storage_path('app/public/avatars/*.*')))
                ->map(fn($path) => 'avatars/' . basename($path))
                ->random(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'stars' => $this->faker->randomFloat(2, 0, 5),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
