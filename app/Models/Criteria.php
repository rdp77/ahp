<?php

namespace App\Models;

use App\Enums\CriteriaTypeEnum;
use App\Enums\RatioTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    public $table = "criteria";

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
        'order',
        'type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => CriteriaTypeEnum::class,
    ];
}
