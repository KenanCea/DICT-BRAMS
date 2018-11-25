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
        Schema::create('health_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('healthfacilities_type');
            $table->integer('numberOfType');
            $table->integer('numberOfPatientsServed');
            $table->string('otherSpecify')->nullable();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('health_facilities', function (Blueprint $table) {
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
        Schema::dropIfExists('health_facilities');
    }
}
