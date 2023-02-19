<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFrontToBuildings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->string('front')->after('address')->nullable()->default(null);
            $table->string('behind')->after('front')->nullable()->default(null);
            $table->string('right')->after('behind')->nullable()->default(null);
            $table->string('left')->after('right')->nullable()->default(null);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->dropColumn('front');
            $table->dropColumn('behind');
            $table->dropColumn('right');
            $table->dropColumn('left');
        });
    }
}
