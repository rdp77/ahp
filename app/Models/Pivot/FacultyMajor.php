<?php

namespace App\Models\Pivot;

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
        'faculty_id',
        'major_id'
    ];
}