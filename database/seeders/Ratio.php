<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ratio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratio')->insert([
            [
                'name' => 'Akreditasi',
                'type' => 'criteria',
            ],
            [
                'name' => 'Minat',
                'type' => 'criteria',
            ],
            [
                'name' => 'Jenis Kelulusan',
                'type' => 'criteria',
            ],
            [
                'name' => 'Bahasa',
                'type' => 'criteria',
            ],
            [
                'name' => 'Sertifikasi atau Pengalaman',
                'type' => 'criteria',
            ],
            [
                'name' => 'Biaya',
                'type' => 'criteria',
            ],
            [
                'name' => 'Kans Kelulusan Tercepat',
                'type' => 'criteria',
            ],
            [
                'name' => 'Masalah Kesehatan',
                'type' => 'criteria',
            ],
            [
                'name' => 'Jenis Kelamin',
                'type' => 'criteria',
            ],
            [
                'name' => 'Status Pekerjaan',
                'type' => 'criteria',
            ],
            [
                'name' => 'Program Studi Ilmu Komunikasi',
                'type' => 'alternative',
            ],
            [
                'name' => 'Program Studi Administrasi Bisnis',
                'type' => 'alternative',
            ],
            [
                'name' => 'Program Studi Administrasi Publik',
                'type' => 'alternative',
            ],
            [
                'name' => 'Sarjana Ilmu Hukum',
                'type' => 'alternative',
            ],
            [
                'name' => 'Ekonomi Pengembangan',
                'type' => 'alternative',
            ],
            [
                'name' => 'Manajemen',
                'type' => 'alternative',
            ],
            [
                'name' => 'Akutansi',
                'type' => 'alternative',
            ],
            [
                'name' => 'Sarjana Psikologi',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Industri',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Mesin',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Sipil',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Arsitektur',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Elektro',
                'type' => 'alternative',
            ],
            [
                'name' => 'Teknik Informatika',
                'type' => 'alternative',
            ],
        ]);
    }
}
