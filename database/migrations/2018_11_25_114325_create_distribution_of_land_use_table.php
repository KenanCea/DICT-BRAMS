<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionOfLandUseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_of_land_use', function (Blueprint $table) {
            $table->increments('id');
            $table->string('land_use_type_residential');
            $table->string('land_use_type_commercial');
            $table->string('land_use_type_industrial');
            $table->string('land_use_type_agricultural');
            $table->string('land_use_type_aquatic');
            $table->string('land_use_type_forest');
            $table->string('land_use_type_idle_land');
            $table->double('land_use_type_residential_landarea');
            $table->double('land_use_type_commercial_landarea');
            $table->double('land_use_type_industrial_landarea');
            $table->double('land_use_type_agricultural_landarea');
            $table->double('land_use_type_aquatic_landarea');
            $table->double('land_use_type_forest_landarea');
            $table->double('land_use_type_residential_population');
            $table->double('land_use_type_commercial_population');
            $table->double('land_use_type_industrial_population');
            $table->double('land_use_type_agricultural_population');
            $table->double('land_use_type_aquatic_population');
            $table->double('land_use_type_forest_population');
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('distribution_of_land_use', function (Blueprint $table) {
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
        Schema::dropIfExists('distribution_of_land_use');
    }
}
