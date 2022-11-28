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

    public function universities()
    {
        return $this->belongsToMany(University::class, 'university_faculty');
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'faculty_major');
    }
}
