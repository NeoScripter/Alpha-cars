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
            'image' => '/images/png/supplier.webp',
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
            'carType' => collect(range(1, rand(1, 3)))
                ->map(fn() => $this->faker->randomElement(['МБ', 'СТ', 'ЛА', 'ГА']))
                ->toArray(),
            'carSubtype' => collect(range(1, rand(5, 18)))
                ->map(fn() => $this->faker->randomElement(['Тягач', 'Самосвал', 'Легковая', 'Спортивная']))
                ->toArray(),
            'carMake' => collect(range(1, rand(5, 18)))
                ->map(fn() => $this->faker->randomElement(['Audi', 'BMW', 'Toyota', 'Honda']))
                ->toArray(),
            'workTerms' => $this->faker->randomElement(['АВ - нет', 'АВ - в круг']),
            'supervisor' => $this->faker->name,
            'dkp' => $this->faker->boolean,
            'image_spec' => $this->faker->boolean,
            'signees' => $this->faker->name,
            'warantees' => $this->faker->boolean,
            'payWithoutPTC' => $this->faker->boolean,
        ];
    }
}
