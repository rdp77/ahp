<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Criteria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria')->insert([
            [
                'name' => 'Minat',
                'sort' => 1
            ],
            [
                'name' => 'Bakat',
                'sort' => 2
            ],
            [
                'name' => 'Jarak',
                'sort' => 3
            ],
            [
                'name' => 'Reputasi',
                'sort' => 4
            ],
            [
                'name' => 'Akreditasi',
                'sort' => 5
            ],
            [
                'name' => 'Pemahaman Dasar',
                'sort' => 6
            ],
            [
                'name' => 'Biaya',
                'sort' => 7
            ],
            [
                'name' => 'Kebutuhan Khusus',
                'sort' => 8
            ],
            [
                'name' => 'Lowongan Pekerjaan',
                'sort' => 9
            ],
            [
                'name' => 'Kelas Khusus',
                'sort' => 10
            ],
        ]);
    }
}
