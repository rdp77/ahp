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

    public function universities()
    {
        return $this->morphToMany(University::class, 'universitible', 'universitibles');
    }
}