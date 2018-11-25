<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housing', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status_of_ownership_house', ['owned', 'rented', 'temporary', 'caretaker']);
            $table->enum('status_of_ownership_lot', ['semi-permanent', 'owned', 'rented', ' permanent', 'concrete', 'caretaker']);
            $table->enum('type_of_dwelling_structure', ['permanent', 'concrete', 'semi-permanent', 'temporary']);
                $table->integer('hhold_id')->unsigned();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('housing', function (Blueprint $table) {
            $table->foreign('hhold_id')->references('id')->on('household')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('housing');
    }
}
