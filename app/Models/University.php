<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;

    public $table = "university";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'email', 'address', 'phone', 'order'
    ];

//    public function faculties()
//    {
//        // relationship to faculty by university_faculty
//        return $this->belongsToMany(Faculty::class, 'university_faculty', 'university_id', 'faculty_id');
//    }
//
//    public function majors()
//    {
//        return $this->hasManyThrough(Major::class, Faculty::class,
//            'university_id', 'faculty_id', 'id', 'id');
//    }

    public function faculties()
    {
        return $this->morphMany(Faculty::class, 'facultyable');
    }

    public function majors()
    {
        return $this->morphMany(Major::class, 'facultyable');
    }

    // relationship through
//    public function majorsThrough()
//    {
//        return $this->hasManyThrough(Major::class, Faculty::class,
//            'university_id', 'faculty_id', 'id', 'id');
//    }
}
