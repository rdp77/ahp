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
                'order' => 1
            ],
            [
                'name' => 'Bakat',
                'order' => 2
            ],
            [
                'name' => 'Jarak',
                'order' => 3
            ],
            [
                'name' => 'Reputasi',
                'order' => 4
            ],
            [
                'name' => 'Akreditasi',
                'order' => 5
            ],
            [
                'name' => 'Pemahaman Dasar',
                'order' => 6
            ],
            [
                'name' => 'Biaya',
                'order' => 7
            ],
            [
                'name' => 'Kebutuhan Khusus',
                'order' => 8
            ],
            [
                'name' => 'Lowongan Pekerjaan',
                'order' => 9
            ],
            [
                'name' => 'Kelas Khusus',
                'order' => 10
            ],
        ]);
    }
}
