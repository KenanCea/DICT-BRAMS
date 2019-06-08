<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfrastructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            //Administrative level (in meters)
            $table->enum('meter_type', ['Concrete', 'Steel', 'Wooden'])->nullable();
            $table->double('national_m', 10);
            $table->double('provincial_m', 10);
            $table->double('city_m', 10);
            $table->double('barangay_m', 10);
            $table->double('total_m', 10);
            $table->string('operational_m', 10);
            $table->double('national_m_total', 10);
            $table->double('provincial_m_total', 10);
            $table->double('city_m_total', 10);
            $table->double('barangay_m_total', 10);
            $table->double('total_m_total', 10);
            $table->string('operational_m_total', 10);
            //Administrative level (in kilometers)
            $table->enum('kilometer_type', ['Concrete', 'Asphalt', 'Gravel', 'Earthfill'])->nullable();
            $table->double('national_km', 10);
            $table->double('provincial_km', 10);
            $table->double('city_km', 10);
            $table->double('barangay_km', 10);
            $table->double('total_km', 10);
            $table->string('operational_km', 10);
            $table->double('national_km_total', 10);
            $table->double('provincial_km_total', 10);
            $table->double('city_km_total', 10);
            $table->double('barangay_km_total', 10);
            $table->double('total_km_total', 10);
            $table->string('operational_km_total');
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
        Schema::dropIfExists('infrastructures');
    }
}
