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

    public function comparisonScale($type)
    {
        $data = $this->where('type', $type)->get();
        $newData = [];
        foreach ($data as $criteria) {
            foreach ($data as $criteria2) {
                if ($criteria === $criteria2) {
                    continue;
                }
                $isDuplicate = false;
                foreach ($newData as $newDataItem) {
                    if ($newDataItem['criteria1'] === $criteria2->id && $newDataItem['criteria2'] === $criteria->id) {
                        $isDuplicate = true;
                        break;
                    }
                }
                if ($isDuplicate) {
                    continue;
                }

                $newData[] = [
                    'id' => $criteria->id . '-' . $criteria2->id,
                    'criteria1' => $criteria->id,
                    'criteria2' => $criteria2->id,
                ];
            }
        }

        return json_encode($newData);
    }

    public function comparisonScaleData($type)
    {
        $data = $this->where('type', $type)->get();
        $newData = [];
        foreach ($data as $criteria) {
            foreach ($data as $criteria2) {
                if ($criteria === $criteria2) {
                    $criteria1Data = 'AUTO';
                    $criteria2Data = 'AUTO';
                }
                foreach ($newData as $newDataItem) {
                    if ($newDataItem['criteria1'] === $criteria2->id && $newDataItem['criteria2'] === $criteria->id) {
                        $criteria1Data = 'AUTO';
                        $criteria2Data = 'AUTO';
                    }
                }

                $newData[] = [
                    'id' => $criteria->id . '-' . $criteria2->id,
                    'criteria1' => $criteria1Data ?? $criteria->id,
                    'criteria2' => $criteria2Data ?? $criteria2->id,
                    'value' => 0,
                ];

                $criteria1Data = null;
                $criteria2Data = null;
            }
        }

        return json_encode($newData);
    }
}
