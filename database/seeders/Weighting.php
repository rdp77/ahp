<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Weighting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scales = [
            ['value' => 1, 'name' => 'Sama pentingnya', 'detail' => 'Kedua elemen mempunyai pengaruh yang sama.'],
            ['value' => 2, 'name' => 'Rata-rata', 'detail' => 'Nilai-nilai antara dua nilai pertimbangan-pertimbangan yang berdekatan, Nilai ini diberikan bila ada dua kompromi di antara 2 pilihan.'],
            ['value' => 3, 'name' => 'Sedikit lebih penting', 'detail' => 'Pengalaman dan penilaian sangat memihak satu elemen dibandingkan dengan pasangannya.'],
            ['value' => 4, 'name' => 'Rata-rata', 'detail' => 'Nilai-nilai antara dua nilai pertimbangan-pertimbangan yang berdekatan, Nilai ini diberikan bila ada dua kompromi di antara 2 pilihan.'],
            ['value' => 5, 'name' => 'Lebih Penting', 'detail' => 'Satu elemen sangat disukai dan secara praktis dominasinya sangat nyata, dibandingkan dengan elemen pasangannya.'],
            ['value' => 6, 'name' => 'Rata-rata', 'detail' => 'Nilai-nilai antara dua nilai pertimbangan-pertimbangan yang berdekatan, Nilai ini diberikan bila ada dua kompromi di antara 2 pilihan.'],
            ['value' => 7, 'name' => 'Sangat penting', 'detail' => 'Satu elemen terbukti sangat disukai dan secara praktis dominasinya sangat, dibandingkan dengan elemen pasangannya.'],
            ['value' => 8, 'name' => 'Rata-rata', 'detail' => 'Nilai-nilai antara dua nilai pertimbangan-pertimbangan yang berdekatan, Nilai ini diberikan bila ada dua kompromi di antara 2 pilihan.'],
            ['value' => 9, 'name' => 'Mutlak lebih penting', 'detail' => 'Satu elemen mutlak lebih disukai dibandingkan dengan pasangannya, pada tingkat keyakinan tertinggi'],
        ];
        DB::table('weighting')->insert($scales);
    }
}
