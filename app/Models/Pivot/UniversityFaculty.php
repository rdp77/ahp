<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Model;

class UniversityFaculty extends Model
{
    public $table = "university_faculty";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'university_id',
        'faculty_id',
    ];
}