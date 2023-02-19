<?php

namespace App\Models;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'phone', 'email', 'gender', 'indentity_number', 'birth_place', 'birth_date'];

    public function building()
    {
        return $this->hasMany(building::class);
    }
}
