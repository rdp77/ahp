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
        'name', 'order'
    ];

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_major');
    }

    public function getMajorsByFacultyId($facultyId)
    {
        return $this->whereHas('faculties', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->get();
    }
}
