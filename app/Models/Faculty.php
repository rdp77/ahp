<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $table = "faculty";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'university_id'
    ];

    // public function university()
    // {
    //     return $this->belongsTo(University::class);
    // }

    // public function major()
    // {
    //     return $this->hasMany(Major::class);
    // }

    public function checkDuplicate()
    {
        $duplicate = self::where('name', 'LIKE', $this->name . '%')->where('id', '!=', $this->id)
            ->pluck('id')->toArray();
        if ($duplicate) return $duplicate;
        else return false;
    }

    public function university()
    {
        return $this->belongsToMany(University::class, 'university_faculty', 'faculty_id', 'university_id');
    }

    public function major()
    {
        return $this->belongsToMany(Major::class, 'faculty_major', 'faculty_id', 'major_id');
    }
}