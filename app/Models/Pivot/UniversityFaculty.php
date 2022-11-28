<?php

namespace App\Models\Pivot;

use App\Models\Faculty;
use App\Models\University;
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
        'university_id', 'faculty_id'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
