<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = [
            [
                'name' => 'Fakultas Ilmu Sosial dan Ilmu Politik',
            ],
            [
                'name' => 'Fakultas Hukum',
            ],
            [
                'name' => 'Fakultas Ekonomi dan Bisnis',
            ],
            [
                'name' => 'Fakultas Psikologi',
            ],
            [
                'name' => 'Fakultas Teknik',
            ]
        ];

        foreach ($faculty as $index => $value) {
            Faculty::create([
                'name' => $value['name'],
                'order' => $index + 1
            ]);
        }
    }
}
