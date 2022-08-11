<?php

namespace App\Models;

use App\Models\Pivot\FacultyMajor;
use App\Models\Pivot\UniversityFaculty;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public $table = "university";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'email',
        'address',
        'phone'
    ];

    // public function faculty()
    // {
    //     return $this->hasMany(Faculty::class);
    // }

    // public function major()
    // {
    //     return $this->hasManyThrough(Major::class, Faculty::class, 'university_id', 'faculty_id', 'id', 'id');
    // }    

    public function faculty()
    {
        return $this->belongsToMany(Faculty::class, 'university_faculty', 'university_id', 'faculty_id');
    }

    public function major()
    {
        return $this->hasManyThrough(
            FacultyMajor::class,
            UniversityFaculty::class,
            'faculty_id',
            'major_id',
            'id',
            'faculty_id'
        );
    }

    // public function major()
    // {
    //     // return $this->belongsToMany(Major::class, Faculty::class, 'university_id', 'faculty_id', 'id', 'id');
    //     return $this->belongsToMany(Major::class, 'university_faculty_major', 'major_id', 'university_id');
    // }
}