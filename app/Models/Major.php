<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use SoftDeletes;

    public $table = "major";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order'
    ];

//    public function faculties()
//    {
//        // relationship to faculty by faculty_id
//        return $this->belongsTo(Faculty::class, 'faculty_id');
//    }

    public function faculties()
    {
        return $this->morphedByMany(Faculty::class, 'facultyable', 'facultyables', 'facultyable_id', 'faculty_id');
    }

    public function universities()
    {
        return $this->morphedByMany(University::class, 'facultyable');
    }
}
