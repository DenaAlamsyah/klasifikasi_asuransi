<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            // * foreign key
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('building_object_id')->constrained('building_objects')->onDelete('cascade');
            $table->foreignId('building_type_id')->constrained('building_types')->onDelete('cascade');
            $table->foreignId('building_flood_area_id')->nullable()->constrained('building_flood_areas')->onDelete('cascade');

            // * other columns
            $table->text('address');
            $table->integer('floors');
            $table->string('roof_type');
            $table->string('wall_type');
            $table->string('floor_type');
            $table->boolean('is_flood_area')->default(false);
            $table->boolean('is_production_process')->default(false);
            $table->boolean('is_wildfire_risk')->default(false);

            // *
            $table->integer('building_value');
            $table->text('security');
            $table->boolean('is_cctv_installed');
            $table->integer('earthquake_area')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
