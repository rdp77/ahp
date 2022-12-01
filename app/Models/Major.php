<?php

namespace App\Models;

use App\Models\Pivot\FacultyMajor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use SoftDeletes;

    public $table = "major";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'order'
    ];

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_major');
    }

    public function getMajorsByFacultyId($facultyId)
    {
        return $this->whereHas('faculties', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->get();
    }

    public function comparisonScale(array $university)
    {
        $data = FacultyMajor::whereIn('university_id', $university)->get()->pluck('major_id')->unique();
        logger($data);
        $data = Major::whereIn('id', $data)->get();
        logger($data);
        $newData = [];
        foreach ($data as $major) {
            foreach ($data as $major2) {
                if ($major === $major2) {
                    continue;
                }
                $isDuplicate = false;
                foreach ($newData as $newDataItem) {
                    if ($newDataItem['alternative1'] === $major2->id && $newDataItem['alternative2'] === $major->id) {
                        $isDuplicate = true;
                        break;
                    }
                }
                if ($isDuplicate) {
                    continue;
                }

                $newData[] = [
                    'id' => $major->id . $major2->id,
                    'alternative1' => $major->id,
                    'alternative2' => $major2->id,
                ];
            }
        }

        return json_encode($newData);
    }
}
