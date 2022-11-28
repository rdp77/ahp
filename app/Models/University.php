<?php

namespace App\Models;

use App\Models\Pivot\FacultyMajor;
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

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'university_faculty');
    }

    public function majors()
    {
        return $this->hasManyThrough(Major::class, FacultyMajor::class, 'university_id',
            'id', 'id', 'major_id');
    }
}
