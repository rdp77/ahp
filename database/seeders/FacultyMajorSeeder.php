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
                        'sort' => 1
                    ],
                    [
                        'name' => 'Program Studi Administrasi Bisnis',
                        'sort' => 2
                    ],
                    [
                        'name' => 'Program Studi Administrasi Publik',
                        'sort' => 3
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Hukum',
                'major' => [
                    [
                        'name' => 'Program Studi Ilmu Hukum',
                        'sort' => 4
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Ekonomi dan Bisnis',
                'major' => [
                    [
                        'name' => 'Program Studi Ekonomi Pengembangan',
                        'sort' => 5
                    ],
                    [
                        'name' => 'Program Studi Manajemen',
                        'sort' => 6
                    ],
                    [
                        'name' => 'Program Studi Akutansi',
                        'sort' => 7
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Psikologi',
                'major' => [
                    [
                        'name' => 'Program Studi Psikologi',
                        'sort' => 8
                    ]
                ],
            ],
            [
                'faculty' => 'Fakultas Teknik',
                'major' => [
                    [
                        'name' => 'Program Studi Teknik Industri',
                        'sort' => 9
                    ],
                    [
                        'name' => 'Program Studi Teknik Mesin',
                        'sort' => 10
                    ],
                    [
                        'name' => 'Program Studi Teknik Sipil',
                        'sort' => 11
                    ],
                    [
                        'name' => 'Program Studi Teknik Arsitektur',
                        'sort' => 12
                    ],
                    [
                        'name' => 'Program Studi Teknik Elektro',
                        'sort' => 13
                    ],
                    [
                        'name' => 'Program Studi Teknik Informatika',
                        'sort' => 14
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
                    'sort' => $major['sort'],
                ]);

                $faculty->majors()->attach($major);
            }
        }
    }
}
