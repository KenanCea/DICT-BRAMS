<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('educational_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('preschool_grad');//Pre-School
            $table->integer('preschool_ugrad');//Pre-School
            $table->integer('preschool_currently_enrolled');//Pre-School
            $table->integer('prielem_grad');//Primary Elementary
            $table->integer('prielem_ugrad');//Primary Elementary
            $table->integer('prielem_currently_enrolled');//Primary Elementary
            $table->integer('secondary_grad');//Secondary
            $table->integer('secondary_ugrad');//Secondary
            $table->integer('secondary_currently_enrolled');//Secondary
            $table->integer('vocational_grad');//vocational
            $table->integer('vocational_ugrad');//vocational
            $table->integer('vocational_currently_enrolled');//vocational
            $table->integer('college_grad');//College
            $table->integer('college_ugrad');//College
            $table->integer('college_currently_enrolled');//college
            $table->integer('postgrad_grad');//Post Graduate
            $table->integer('postgrad_ugrad');//Post Graduate
            $table->integer('postgrad_currently_enrolled');//Post Graduate
            $table->integer('zero_eleven_1degree');//0-11 months old
            $table->integer('zero_eleven_2degree');//0-11 months old
            $table->integer('zero_eleven_3degree');//0-11 months old
            $table->integer('one_four_1degree');//1-4 years old
            $table->integer('one_four_2degree');//1-4 years old
            $table->integer('one_four_3degree');//1-4 years old
            $table->integer('five_seven_1degree');//5 - under 7 years old
            $table->integer('five_seven_2degree');//5 - under 7 years old
            $table->integer('five_seven_3degree');//5 - under 7 years old
            $table->timestamps();
            $table->unsignedInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educational_infos');
    }
}
