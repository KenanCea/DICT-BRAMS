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
            $table->double('national_m_concrete', 10);
            $table->double('provincial_m_concrete', 10);
            $table->double('city_m_concrete', 10);
            $table->double('barangay_m_concrete', 10);
            $table->double('total_m_concrete', 10);
            $table->string('operational_m_concrete', 10);
            $table->double('national_m_steel', 10);
            $table->double('provincial_m_steel', 10);
            $table->double('city_m_steel', 10);
            $table->double('barangay_m_steel', 10);
            $table->double('total_m_steel', 10);
            $table->string('operational_m_steel', 10);
            $table->double('national_m_wooden', 10);
            $table->double('provincial_m_wooden', 10);
            $table->double('city_m_wooden', 10);
            $table->double('barangay_m_wooden', 10);
            $table->double('total_m_wooden', 10);
            $table->string('operational_m_wooden', 10);
            $table->double('national_m_total', 10);
            $table->double('provincial_m_total', 10);
            $table->double('city_m_total', 10);
            $table->double('barangay_m_total', 10);
            $table->double('total_m_total', 10);
            $table->string('operational_m_total', 10);
            //Administrative level (in kilometers)
            $table->double('national_km_concrete', 10);
            $table->double('provincial_km_concrete', 10);
            $table->double('city_km_concrete', 10);
            $table->double('barangay_km_concrete', 10);
            $table->double('total_km_concrete', 10);
            $table->string('operational_km_concrete', 10);
            $table->double('national_km_asphalt', 10);
            $table->double('provincial_km_asphalt', 10);
            $table->double('city_km_asphalt', 10);
            $table->double('barangay_km_asphalt', 10);
            $table->double('total_km_asphalt', 10);
            $table->string('operational_km_asphalt', 10);
            $table->double('national_km_gravel', 10);
            $table->double('provincial_km_gravel', 10);
            $table->double('city_km_gravel', 10);
            $table->double('barangay_km_gravel', 10);
            $table->double('total_km_gravel', 10);
            $table->string('operational_km_gravel', 10);
            $table->double('national_km_earthfill', 10);
            $table->double('provincial_km_earthfill', 10);
            $table->double('city_km_earthfill', 10);
            $table->double('barangay_km_earthfill', 10);
            $table->double('total_km_earthfill', 10);
            $table->string('operational_km_earthfill', 10);
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
