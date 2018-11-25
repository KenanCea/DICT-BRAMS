<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterSupplySourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_supply_source', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('level1', ['deepwell public', 'spring', 'deepwell private']);
            $table->enum('level2', ['deepwell public', 'spring', 'deepwell private']);
            $table->enum('level3', ['deepwell public', 'spring', 'deepwell private']);
                $table->integer('hhold_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('water_supply_source', function (Blueprint $table) {
            $table->foreign('hhold_id')->references('id')->on('household')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('water_supply_source');
    }
}
