<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universitibles extends Model
{
    public $table = "universitibles";
    protected $guarded = [];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
}