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
        'code',
        'email',
        'address',
        'phone'
    ];

    public function university()
    {
        $this->belongsTo(University::class);
    }

    public function Major()
    {
        $this->hasMany(Major::class);
    }
}