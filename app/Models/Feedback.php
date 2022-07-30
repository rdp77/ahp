<?php

namespace App\Models;

use App\Enums\ReactTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = "feedback";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'react',
        'comment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'react' => ReactTypeEnum::class
    ];
}