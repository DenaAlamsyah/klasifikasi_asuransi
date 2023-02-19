<?php

namespace App\Models;

use App\Models\BuildingFloodArea;
use App\Models\BuildingObject;
use App\Models\BuildingType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Phpml\Classification\NaiveBayes;

class Building extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'customer_id',
        'building_object_id',
        'building_type_id',
        'building_flood_area_id',
        'address',
        'floors',
        'roof_type',
        'wall_type',
        'floor_type',
        'is_production_process',
        'is_wildfire_risk',
        'security',
        'is_cctv_installed',
        'earthquake_area',
        'building_value',
        'status'
    ];

    // protected $appends = [
    //     'prediction'
    // ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function buildingObject()
    {
        return $this->belongsTo(BuildingObject::class);
    }

    public function buildingType()
    {
        return $this->hasOne(BuildingType::class);
    }

    public function buildingFloodArea()
    {
        return $this->hasOne(BuildingFloodArea::class);
    }

    public function getPredictionAttribute()
    {
        $classifier = new NaiveBayes();
        $historical = $this->whereNotNull('status')->get();

        $history_samples = [];
        $history_labels = [];

        foreach ($historical as $history) {
            // array_push($history_samples, implode('|', Arr::except($history->toArray(), ['id', 'customer_id', 'address', 'status', 'created_at', 'updated_at', 'deleted_at'])));
            // array_push($history_samples, array_values(Arr::except($history->toArray(), ['id', 'customer_id', 'address', 'status', 'created_at', 'updated_at', 'deleted_at'])));
            $models = array_values(Arr::except($history->toArray(), ['id', 'customer_id', 'address', 'status', 'created_at', 'updated_at', 'deleted_at']));
            $model_arr = [];

            foreach ($models as $model) {
                array_push($model_arr, strval($model));
            }

            array_push($history_samples, $model_arr);
            array_push($history_labels, $history->status);
        }

        // return $history_samples;

        $classifier->train($history_samples, $history_labels);

        // $current_samples = implode('|', Arr::except($this->toArray(), ['id', 'customer_id', 'address', 'status', 'created_at', 'updated_at', 'deleted_at']));

        $models = array_values(Arr::except($this->toArray(), ['id', 'customer_id', 'address', 'status', 'created_at', 'updated_at', 'deleted_at']));
        $model_arr = [];

        foreach ($models as $model) {
            if (is_array($model)) {
                array_push($model_arr, '');
            } else {
                array_push($model_arr, strval($model));
            }
        }

        return $classifier->predict([$model_arr])[0];
    }
}
