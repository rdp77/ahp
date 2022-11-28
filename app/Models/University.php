<?php

namespace App\Models;

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
}
