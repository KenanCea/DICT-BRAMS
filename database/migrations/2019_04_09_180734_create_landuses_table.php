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
            $table->enum('landuse_type', ['Residential', 'Commercial', 'Industrial', 'Agricultural', 'Aquatic', 'Forest', 'Idle']);
            $table->double('land_area_sqm', 10);
            $table->double('land_area_hec', 10);
            $table->double('totalpop', 10);
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
