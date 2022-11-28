<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $university = [
            [
                'name' => 'Universitas 17 Agustus 1945 Surabaya',
                'code' => 'UNTAG',
                'email' => 'untag@university.id',
                'address' => 'Jl. Raya ITS Sukolilo, Surabaya, Jawa Timur 60111',
                'phone' => '031-123456',
            ],
            [
                'name' => 'Universitas Airlangga',
                'code' => 'UNAIR',
                'email' => 'unair@university.id',
                'address' => 'Jl. Raya ITS Sukolilo, Surabaya, Jawa Timur 60111',
                'phone' => '031-123456',
            ],
            [
                'name' => 'Institut Teknologi Sepuluh November',
                'code' => 'ITS',
                'email' => 'its@university.id',
                'address' => 'Jl. Raya ITS Sukolilo, Surabaya, Jawa Timur 60111',
                'phone' => '031-123456',
            ],
            [
                'name' => 'Universitas Brawijaya',
                'code' => 'UB',
                'email' => 'ub@university.id',
                'address' => 'Jl. Raya ITS Sukolilo, Surabaya, Jawa Timur 60111',
                'phone' => '031-123456',
            ],
            [
                'name' => 'Universitas Trunojoyo Madura',
                'code' => 'UTM',
                'email' => 'utm@university.id',
                'address' => 'Jl. Raya ITS Sukolilo, Surabaya, Jawa Timur 60111',
                'phone' => '031-123456',
            ],
        ];

        foreach ($university as $index => $value) {
            University::create([
                'name' => $value['name'],
                'code' => $value['code'],
                'email' => $value['email'],
                'address' => $value['address'],
                'phone' => $value['phone'],
                'order' => $index + 1
            ]);
        }
    }
}
