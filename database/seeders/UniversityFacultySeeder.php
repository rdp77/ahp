<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Database\Seeder;

class UniversityFacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::find(1)->faculties()->attach([1, 3, 4, 5]);
        University::find(2)->faculties()->attach([1, 2, 4, 5]);
        University::find(3)->faculties()->attach([1, 2, 3, 5]);
        University::find(4)->faculties()->attach([1, 4, 5]);
        University::find(5)->faculties()->attach([1, 2,]);
    }
}
