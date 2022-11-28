<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major = [
            [
                'name' => 'Program Studi Ilmu Komunikasi',
            ],
            [
                'name' => 'Program Studi Administrasi Bisnis',
            ],
            [
                'name' => 'Program Studi Administrasi Publik',
            ],
            [
                'name' => 'Program Studi Ilmu Hukum',
            ],
            [
                'name' => 'Program Studi Ekonomi Pengembangan',
            ],
            [
                'name' => 'Program Studi Manajemen',
            ],
            [
                'name' => 'Program Studi Akutansi',
            ],
            [
                'name' => 'Program Studi Psikologi',
            ],
            [
                'name' => 'Program Studi Teknik Informatika',
            ],
            [
                'name' => 'Program Studi Teknik Elektro',
            ],
            [
                'name' => 'Program Studi Teknik Sipil',
            ],
            [
                'name' => 'Program Studi Teknik Mesin',
            ],
            [
                'name' => 'Program Studi Teknik Industri',
            ],
            [
                'name' => 'Program Studi Teknik Arsitektur',
            ],
        ];

        foreach ($major as $key => $value) {
            Major::create([
                'name' => $value['name'],
                'order' => $key + 1
            ]);
        }
    }
}
