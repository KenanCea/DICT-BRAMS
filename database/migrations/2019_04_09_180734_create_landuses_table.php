<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('landuses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('residential_land_area_sqm', 10);
            $table->double('residential_land_area_hec', 10);
            $table->double('residential_totalpop', 10);
            $table->double('commercial_land_area_sqm', 10);
            $table->double('commercial_land_area_hec', 10);
            $table->double('commercial_totalpop', 10);
            $table->double('industrial_land_area_sqm', 10);
            $table->double('industrial_land_area_hec', 10);
            $table->double('industrial_totalpop', 10);
            $table->double('agricultural_land_area_sqm', 10);
            $table->double('agricultural_land_area_hec', 10);
            $table->double('agricultural_totalpop', 10);
            $table->double('aquatic_land_area_sqm', 10);
            $table->double('aquatic_land_area_hec', 10);
            $table->double('aquatic_totalpop', 10);
            $table->double('forest_land_area_sqm', 10);
            $table->double('forest_land_area_hec', 10);
            $table->double('forest_totalpop', 10);
            $table->double('idle_land_area_sqm', 10);
            $table->double('idle_land_area_hec', 10);
            $table->double('idle_land_area_totalpop', 10);
            $table->integer('total_no_hhold' );
            $table->integer('ave_persons_hhold');
            $table->double('ave_income_hhold', 10);
            $table->string('rank1_employment');
            $table->string('rank2_employment');
            $table->string('rank3_employment');
            $table->timestamps();
            $table->unsignedInteger('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landuses');
    }
}
