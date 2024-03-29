<?php

namespace App\Models\Pivot;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;

class FacultyMajor extends Model
{
    public $table = "faculty_major";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'university_id', 'faculty_id', 'major_id'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
