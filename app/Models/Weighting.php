<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weighting extends Model
{
    public $table = "weighting";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'detail',
    ];
}
