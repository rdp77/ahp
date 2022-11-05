<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    public $table = "faculty";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'university_id'
    ];

//    public function universities()
//    {
//        // relationship to university by university_id
//        return $this->belongsTo(University::class, 'university_id');
//    }
//
//    public function majors()
//    {
//        // relationship to major by faculty_id
//        return $this->hasMany(Major::class, 'faculty_id');
//    }

    public function universities()
    {
        return $this->morphedByMany(University::class, 'facultyable');
    }

    public function majors()
    {
        return $this->morphedByMany(Major::class, 'facultyable');
    }
}
