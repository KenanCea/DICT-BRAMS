<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('education', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('no_pre_school_building')->nullable();
            $table->integer('no_primary_building')->nullable();
            $table->integer('no_secondary_building')->nullable();
            $table->integer('no_vocational_building')->nullable();
            $table->integer('no_college_building')->nullable();
            $table->integer('no_post_graduate_building')->nullable();
            $table->integer('no_covered_courts')->nullable();
            $table->integer('no_gymnasiums')->nullable();
            $table->integer('no_parks_plaza')->nullable();
            $table->string('others_sport_facilities', 20)->nullable();
            $table->string('recreational_activities', 20)->nullable();
            $table->integer('total_facilities')->nullable();
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
        Schema::dropIfExists('education');
    }
}
