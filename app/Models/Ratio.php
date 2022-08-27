<?php

namespace App\Models;

use App\Enums\RatioTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Ratio extends Model
{
    public $table = "ratio";

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
        'type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => RatioTypeEnum::class,
    ];
}
