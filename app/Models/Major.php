<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $table = "major";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'faculty_id',
    ];

    // public function faculty()
    // {
    //     return $this->belongsTo(Faculty::class);
    // }

    public function checkDuplicate()
    {
        $duplicate = self::where('name', 'LIKE', $this->name . '%')->where('id', '!=', $this->id)
            ->pluck('id')->toArray();
        if ($duplicate) return $duplicate;
        else return false;
    }

    public function faculty()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_major', 'major_id', 'faculty_id');
    }
}