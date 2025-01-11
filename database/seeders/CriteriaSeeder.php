<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Criteria::count() == 0) {
            Criteria::create([
                'carTypes' => [
                    'ГА',
                    'ЛА',
                    'МБ',
                    'СТ',
                ],
                'carSubtypes' => [
                    'Легковая',
                    'Самосвал',
                    'Спортивная',
                    'Тягач',
                ],
                'carMakes' => [
                    'Audi',
                    'BMW',
                    'Honda',
                    'Toyota',
                ],
                'workTerms' => [
                    'АВ - в круг',
                    'АВ - не в круг',
                ],
                'rating' => [
                    'A',
                    'B',
                    'C',
                    'D',
                    'E',
                    'нет рейтинга',
                ],
            ]);
        }
    }
}
