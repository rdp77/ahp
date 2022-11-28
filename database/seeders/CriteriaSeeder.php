<?php

namespace Database\Seeders;

use App\Enums\CriteriaTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteriaUniversity = [
            [
                'name' => 'Biaya',
            ],
            [
                'name' => 'Jarak',
            ],
            [
                'name' => 'Persyaratan Masuk',
            ],
            [
                'name' => 'Mata Kuliah',
            ],
            [
                'name' => 'Beasiswa',
            ],
            [
                'name' => 'Jenis',
            ],
            [
                'name' => 'Ranking',
            ],
            [
                'name' => 'Akreditasi',
            ],
            [
                'name' => 'Prestasi',
            ],
            [
                'name' => 'Rekomendasi',
            ],
        ];

        $criteriaMajor = [
            [
                'name' => 'Minat'
            ],
            [
                'name' => 'Bakat'
            ],
            [
                'name' => 'Jarak'
            ],
            [
                'name' => 'Reputasi'
            ],
            [
                'name' => 'Akreditasi'
            ],
            [
                'name' => 'Pemahaman Dasar'
            ],
            [
                'name' => 'Biaya'
            ],
            [
                'name' => 'Kebutuhan Khusus'
            ],
            [
                'name' => 'Lowongan Pekerjaan'
            ],
            [
                'name' => 'Kelas Khusus'
            ]

        ];

        foreach ($criteriaUniversity as $index => $criteria) {
            DB::table('criteria')->insert([
                'name' => $criteria['name'],
                'order' => $index + 1,
                'type' => CriteriaTypeEnum::UNIVERSITY,
            ]);
        }

        foreach ($criteriaMajor as $index => $criteria) {
            DB::table('criteria')->insert([
                'name' => $criteria['name'],
                'order' => $index + 1,
                'type' => CriteriaTypeEnum::MAJOR,
            ]);
        }
    }
}
