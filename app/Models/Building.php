<?php

namespace App\Models;

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
        'building_value'
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
