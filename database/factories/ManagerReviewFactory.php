<?php

namespace Database\Factories;

use App\Models\Manager;
use App\Models\ManagerReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManagerReview>
 */
class ManagerReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ManagerReview::class;

    public function definition()
    {
        return [
            'overallStars' => $this->faker->randomFloat(1, 1, 5),
            'responseSpeedStars' => $this->faker->randomFloat(1, 1, 5),
            'priceStars' => $this->faker->randomFloat(1, 1, 5),
            'keepsWordStars' => $this->faker->randomFloat(1, 1, 5),
            'content' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'manager_id' => Manager::factory(),
        ];
    }
}
