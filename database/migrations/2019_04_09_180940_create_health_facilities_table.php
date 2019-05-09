<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('health_facilities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pubhos_num');
            $table->integer('pubhos_numpatients');
            $table->integer('prihos_num');
            $table->integer('prihos_numpatients');
            $table->integer('healthcenter_num');
            $table->integer('healthcenter_numpatients');
            $table->integer('clinic_num');
            $table->integer('clinic_numpatients');
            $table->integer('self_medication_num');
            $table->integer('self_medication_numpatients');
            $table->string('otherSpecify')->nullable();
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
        Schema::dropIfExists('health_facilities');
    }
}
