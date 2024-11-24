<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'name' => $this->faker->company,
            'stars' => $this->faker->randomFloat(1, 1, 5),
            'emails' => [$this->faker->safeEmail],
            'phones' => [$this->faker->phoneNumber],
            'website' => $this->faker->url,
            'platform_address' => $this->faker->address,
            'unload_address' => $this->faker->address,
            'legal_entity' => $this->faker->companySuffix,
            'itn' => $this->faker->numerify('##########'),
            'rrc' => $this->faker->word,
            'rating' => $this->faker->randomElement(['A', 'B', 'C']),
            'carType' => $this->faker->word,
            'carSubtype' => [$this->faker->word],
            'carMake' => [$this->faker->word],
            'workTerms' => $this->faker->sentence,
            'supervisor' => $this->faker->name,
            'dkp' => $this->faker->boolean,
            'image_spec' => $this->faker->boolean,
            'signees' => $this->faker->name,
            'warantees' => $this->faker->boolean,
            'payWithoutPTC' => $this->faker->boolean,
        ];
    }
}
