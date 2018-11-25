<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_covered_courts');
            $table->integer('num_gymnasium');
            $table->integer('num_park_plaza');
            $table->string('other_sport_facilities');
            $table->integer('other_sport_facilities_num');
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('sport', function (Blueprint $table) {
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
        Schema::dropIfExists('sport');
    }
}
