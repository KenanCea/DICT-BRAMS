<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBridgeInMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bridge_in_meters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_land_use');
            $table->double('admin_level_national_meter');
            $table->double('admin_level_provincial_meter');
            $table->double('admin_level_city/mun_meter');
            $table->double('admin_level_barangay_meter');
            $table->double('admin_level_totalmeter_meter');
            $table->string('admin_level_operational_meter');
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('bridge_in_meters', function (Blueprint $table) {
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
        Schema::dropIfExists('bridge_in_meters');
    }
}
