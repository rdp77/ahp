<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Database\Seeder;

class FacultyMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultyMajor = [
            [
                'faculty' => 'Fakultas Ilmu Sosial dan Ilmu Politik',
                'major' => [
                    [
                        'name' => 'Program Studi Ilmu Komunikasi',
                        'order' => 1
                    ],
                    [
                        'name' => 'Program Studi Administrasi Bisnis',
                        'order' => 2
                    ],
                    [
                        'name' => 'Program Studi Administrasi Publik',
                        'order' => 3
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Hukum',
                'major' => [
                    [
                        'name' => 'Program Studi Ilmu Hukum',
                        'order' => 4
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Ekonomi dan Bisnis',
                'major' => [
                    [
                        'name' => 'Program Studi Ekonomi Pengembangan',
                        'order' => 5
                    ],
                    [
                        'name' => 'Program Studi Manajemen',
                        'order' => 6
                    ],
                    [
                        'name' => 'Program Studi Akutansi',
                        'order' => 7
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Psikologi',
                'major' => [
                    [
                        'name' => 'Program Studi Psikologi',
                        'order' => 8
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Teknik',
                'major' => [
                    [
                        'name' => 'Program Studi Teknik Industri',
                        'order' => 9
                    ],
                    [
                        'name' => 'Program Studi Teknik Mesin',
                        'order' => 10
                    ],
                    [
                        'name' => 'Program Studi Teknik Sipil',
                        'order' => 11
                    ],
                    [
                        'name' => 'Program Studi Teknik Arsitektur',
                        'order' => 12
                    ],
                    [
                        'name' => 'Program Studi Teknik Elektro',
                        'order' => 13
                    ],
                    [
                        'name' => 'Program Studi Teknik Informatika',
                        'order' => 14
                    ]
                ],
            ],
        ];

        foreach ($facultyMajor as $value) {
            $faculty = Faculty::create([
                'name' => $value['faculty'],
            ]);

            foreach ($value['major'] as $major) {
                $major = Major::create([
                    'name' => $major['name'],
                    'order' => $major['order'],
                ]);

                $faculty->majors()->attach($major);
            }
        }
    }
}
