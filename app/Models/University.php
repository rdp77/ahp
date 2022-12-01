<?php

namespace App\Models;

use App\Models\Pivot\FacultyMajor;
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

    public function majors()
    {
        return $this->hasManyThrough(Major::class, FacultyMajor::class, 'university_id',
            'id', 'id', 'major_id');
    }

    public function comparisonScale()
    {
        $data = self::all();
        $newData = [];
        foreach ($data as $university) {
            foreach ($data as $university2) {
                if ($university === $university2) {
                    continue;
                }
                $isDuplicate = false;
                foreach ($newData as $newDataItem) {
                    if ($newDataItem['alternative1'] === $university2->id && $newDataItem['alternative2'] === $university->id) {
                        $isDuplicate = true;
                        break;
                    }
                }
                if ($isDuplicate) {
                    continue;
                }

                $newData[] = [
                    'id' => $university->id . $university2->id,
                    'alternative1' => $university->id,
                    'alternative2' => $university2->id,
                ];
            }
        }

        return json_encode($newData);
    }
}
