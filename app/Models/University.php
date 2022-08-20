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

    public function faculty()
    {
        return $this->morphedByMany(Faculty::class, 'universitible', 'universitibles');
    }

    public function major()
    {
        return $this->morphedByMany(Major::class, 'universitible', 'universitibles');
    }
}