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
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_pre_school_building')->nullable();
            $table->integer('no_primary_building')->nullable();
            $table->integer('no_secondary_building')->nullable();
            $table->integer('no_vocational_building')->nullable();
            $table->integer('no_college_building')->nullable();
            $table->integer('no_post_graduate_building')->nullable();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('education', function (Blueprint $table) {
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
        Schema::dropIfExists('education');
    }
}
