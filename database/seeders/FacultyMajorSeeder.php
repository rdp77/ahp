<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
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
        Faculty::find(1)->majors()->attach([1, 7,], ['university_id' => 1]);
        Faculty::find(2)->majors()->attach([1, 2, 3, 4], ['university_id' => 2]);
        Faculty::find(3)->majors()->attach([1, 2, 3, 10], ['university_id' => 3]);
        Faculty::find(4)->majors()->attach([1, 7, 8, 9, 10], ['university_id' => 4]);
        Faculty::find(5)->majors()->attach([5, 6, 9], ['university_id' => 5]);
    }
}
