<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('barangayProfile', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('barangay_name_barangay');
            $table->string('province_barangay');
            $table->string('muni_city_barangay'); 
            $table->string('region_barangay');
            $table->string('legal_basis_barangay');
            $table->date('date_legal_basis'); 
            $table->date('date_ratification');
            $table->string('mother_barangay');
            $table->string('old_name');
            $table->enum('type_barangay', ['rural', 'urban', 'tribal']);
            $table->double('boundaries_north');
            $table->double('boundaries_east');
            $table->double('boundaries_west');
            $table->double('boundaries_south');
            $table->double('totalland_area_sqkm');
            $table->double('totalland_area_hec');
            $table->double('distance_municipal_city');
            $table->string('province_capitol');
            $table->string('national_highway');
            $table->string('landform_type');
            $table->integer('landform_percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangayProfile');
    }
}
