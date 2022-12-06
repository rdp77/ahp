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
        $data = Major::whereIn('id', $data)->get();
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
                    'id' => $major->id . '-' . $major2->id,
                    'alternative1' => $major->id,
                    'alternative2' => $major2->id,
                ];
            }
        }

        return json_encode($newData);
    }

    public function comparisonScaleData(array $university)
    {
        $data = FacultyMajor::whereIn('university_id', $university)->get()->pluck('major_id')->unique();
        $data = Major::whereIn('id', $data)->get();
        $newData = [];
        foreach ($data as $major) {
            foreach ($data as $major2) {
                if ($major === $major2) {
                    $alternative1Data = 'AUTO';
                    $alternative2Data = 'AUTO';
                }
                foreach ($newData as $newDataItem) {
                    if ($newDataItem['alternative1'] === $major2->id && $newDataItem['alternative2'] === $major->id) {//
                        $alternative1Data = 'AUTO';
                        $alternative2Data = 'AUTO';
                    }
                }

                $newData[] = [
                    'id' => $major->id . '-' . $major2->id,
                    'alternative1' => $alternative1Data ?? $major->id,
                    'alternative2' => $alternative2Data ?? $major2->id,
                    'value' => 0,
                ];

                $alternative1Data = null;
                $alternative2Data = null;
            }
        }

        return json_encode($newData);
    }
}
