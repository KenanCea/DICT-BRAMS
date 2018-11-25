<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBridgeInKilometersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bridge_in_kilometers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_level_type_land_use_kilo');
            $table->double('admin_level_national_kilo');
            $table->double('admin_level_provincial_kilo');
            $table->double('admin_level_city/mun_kilo');
            $table->double('admin_level_barangay_kilo');
            $table->string('admin_level_operational_kilo');
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('bridge_in_kilometers', function (Blueprint $table) {
            $table->foreign('barangay_id')->references('id')->on('barangayProfile')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bridge_in_kilometers');
    }
}
