<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('barangays', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique();
            $table->enum('province',['Benguet']);
            $table->enum('muni_city',['Baguio']); 
            $table->enum('region',['CAR']);
            $table->string('legal_basis');
            $table->date('date_legal_basis'); 
            $table->date('date_ratification');
            $table->string('mother_barangay', 20)->nullable();
            $table->string('old_name',20)->nullable();
            $table->enum('type_barangay', ['Rural', 'Urban', 'Tribal']);
            $table->double('boundaries_north', 7);
            $table->double('boundaries_east',7);
            $table->double('boundaries_west',7);
            $table->double('boundaries_south',7);
            $table->double('totalland_area_sqkm',9);
            $table->double('totalland_area_hec',9);
            $table->double('distance_municipal_city',9);
            $table->double('province_capitol', 9);
            $table->double('national_highway', 9);
            $table->enum('mountainous',['0-25%','26-50%','51-75%','76-100%']);//landform type
            $table->enum('plain',['0-25%','26-50%','51-75%','76-100%']);//landform type
            $table->enum('valley',['0-25%','26-50%','51-75%','76-100%']);//landform type
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangays');
    }
}
