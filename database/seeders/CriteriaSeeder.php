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
                'description' => 'Total biaya selama kuliah'
            ],
            [
                'name' => 'Jarak',
                'description' => 'Jarak antara lokasi dengan universitas'
            ],
            [
                'name' => 'Persyaratan Masuk',
                'description' => 'Persyaratan yang dibutuhkan untuk masuk kedalam universitas'
            ],
            [
                'name' => 'Mata Kuliah',
                'description' => 'Total mata kuliah atau jenis dari matakuliah yang dipelajari'
            ],
            [
                'name' => 'Beasiswa',
                'description' => 'Adanya dukungan beasiswa untuk mahasiswa dari universitas'
            ],
            [
                'name' => 'Jenis',
                'description' => 'Jenis Universitas, seperti swasta, universitas terbuka atau negeri'
            ],
            [
                'name' => 'Ranking',
                'description' => 'Ranking universitas dari terkecil sampai terbesar'
            ],
            [
                'name' => 'Akreditasi',
                'description' => 'Akreditasi yang diperoleh oleh universitas'
            ],
            [
                'name' => 'Prestasi',
                'description' => 'Riwayat prestasi mahasiswa yang telah dilakukan di universitas tersebut'
            ],
            [
                'name' => 'Rekomendasi',
                'description' => 'Rekomendasi dari mahasiswa, dosen, rekan, ataupun keluarga'
            ],
        ];

        $criteriaMajor = [
            [
                'name' => 'Minat',
                'description' => 'Minat mahasiswa dalam mempelajari jurusan tersebut'
            ],
            [
                'name' => 'Bakat',
                'description' => 'Adanya bakat untuk lebih cepat memahami dan mempelajari terkait jurusan tersebut'
            ],
            [
                'name' => 'Jarak',
                'description' => 'Jarak antara lokasi dengan jurusan atau fakultas'
            ],
            [
                'name' => 'Reputasi',
                'description' => 'Reputasi yang pernah diperoleh terkait jurusan tersebut'
            ],
            [
                'name' => 'Akreditasi',
                'description' => 'Akreditasi yang diperoleh oleh jurusan'
            ],
            [
                'name' => 'Pemahaman Dasar',
                'description' => 'Pemahaman dasar mahasiswa terkait jurusan tersebut'
            ],
            [
                'name' => 'Biaya',
                'description' => 'Total biaya selama menempuh kuliah di jurusan tersebut'
            ],
            [
                'name' => 'Kebutuhan Khusus',
                'description' => 'Prioritas kebutuhan khusus mahasiswa terhadap jurusan tersebut'
            ],
            [
                'name' => 'Lowongan Pekerjaan',
                'description' => 'Banyaknya minat di bidang industri terkait dengan jurusan tersebut'
            ],
            [
                'name' => 'Kelas Khusus',
                'description' => 'Adanya kelas khusus untuk meningkatkan softskill dan hardskill'
            ]

        ];

        foreach ($criteriaUniversity as $index => $criteria) {
            DB::table('criteria')->insert([
                'name' => $criteria['name'],
                'description' => $criteria['description'],
                'order' => $index + 1,
                'type' => CriteriaTypeEnum::UNIVERSITY,
            ]);
        }

        foreach ($criteriaMajor as $index => $criteria) {
            DB::table('criteria')->insert([
                'name' => $criteria['name'],
                'description' => $criteria['description'],
                'order' => $index + 1,
                'type' => CriteriaTypeEnum::MAJOR,
            ]);
        }
    }
}
