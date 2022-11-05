<?php

namespace App\Models\Pivot;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;

class Facultyable extends Model
{
    public $table = "facultyables";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facultyable_id', 'facultyable_type', 'faculty_id'
    ];

    public function faculties()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function facultyables()
    {
        return $this->morphTo();
    }

    public function universities()
    {
        return $this->morphedByMany(University::class, 'facultyable');
    }

    public function majors()
    {
        return $this->morphedByMany(Major::class, 'facultyable');
    }

    // get all facultyables by university_id
    public function getFacultyablesByUniversityId($university)
    {
        return $this->where('facultyable_id', $university->id)
            ->where('facultyable_type', 'App\Models\University')
            ->get();
    }

    public function getFacultyablesByUniversityIdWithFaculties($university)
    {
        return $this->where('facultyable_id', $university->id)
            ->where('facultyable_type', 'App\Models\University')
            ->with('faculties')
            ->get();
    }

    public function getFacultyablesByUniversityIdWithFacultiesAndMajors($university)
    {
        return $this->where('facultyable_id', $university->id)
            ->where('facultyable_type', 'App\Models\University')
            ->with('faculties')
            ->with('majors')
            ->get();
    }
}
