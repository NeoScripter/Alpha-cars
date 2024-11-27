<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\SupplierReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierReview>
 */
class SupplierReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SupplierReview::class;

    public function definition(): array
    {
        return [
            'stars' => $this->faker->randomFloat(1, 1, 5),
            'content' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
