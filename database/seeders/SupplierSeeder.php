<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::factory()
        ->has(Manager::factory()->count(4))
        ->count(20)
        ->create();

    }
}
