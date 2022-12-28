<?php

namespace Database\Seeders;

use App\Models\BuildingObject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BuildingObjectSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingObject::insert([
            'name' => Str::upper('hotel'),
            'description' => 'jenis bangunan hotel'
        ]);
        BuildingObject::create([
            'name' => Str::upper('gudang'),
            'description' => 'jenis bangunan gudang'
        ]);
        BuildingObject::create([
            'name' => Str::upper('kantor'),
            'description' => 'jenis bangunan kantor'
        ]);
        BuildingObject::create([
            'name' => Str::upper('rumah'),
            'description' => 'jenis bangunan rumah'
        ]);
        BuildingObject::create([
            'name' => Str::upper('pabrik'),
            'description' => 'jenis bangunan pabrik'
        ]);
        BuildingObject::create([
            'name' => Str::upper('toko restoran'),
            'description' => 'jenis bangunan toko restoran'
        ]);
        BuildingObject::create([
            'name' => Str::upper('apartement'),
            'description' => 'jenis bangunan apartement'
        ]);
    }
}
