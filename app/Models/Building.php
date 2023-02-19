<?php

namespace App\Models;

use App\Models\BuildingFloodArea;
use App\Models\BuildingObject;
use App\Models\BuildingType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
