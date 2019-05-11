<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('environment_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->enum('Level1',['Spring','Deepwell public','Deepwell private']);//Water Supply
            $table->enum('Level2',['Public Faucet','Box Spring']);//Water Supply
            $table->enum('Level3',['Piped(in house)','Piped(public)']);//Water Supply
            $table->enum('tank',['y','n']);//water storage facility
            $table->enum('elevated_tank',['y','n']);//water storage facility
            $table->enum('jars',['y','n']);//water storage facility
            $table->enum('drums/cans',['y','n']);//water storage facility
            $table->enum('plastic_conatainers',['y','n']);//water storage facility
            $table->string('others_water_storage');//water storage facility
            $table->enum('market',['y','n']);//Food Service  
            $table->enum('sarisaristore',['y','n']);//Food Service  
            $table->enum('ambulant_vendor',['y','n']);//Food Service  
            $table->string('others_food_service');//Food Service  
            $table->enum('refrigerator',['y','n']);//Household storage
            $table->enum('cabinet/shelves',['y','n']);//Household storage
            $table->string('others_hhold_storage');//Household storage
            $table->enum('fresh',['y','n']);//Kind of food storage
            $table->enum('dried',['y','n']);//Kind of food storage
            $table->enum('processed',['y','n']);//Kind of food storage
            $table->string('others_kind_of_foodstorage');//Kind of food storage
            $table->enum('with',['Flush with Septic','Flush with sewer','Water sealed(pit)','Pit Privy']);//Toilet Facilites
            $table->enum('drainage',['W/o drainage','Open drainage','Blind drainage']);//Drainage Facilites
            $table->enum('city/mun_collection',['y','n']);//Garbage Disposal
            $table->enum('communal_pit',['y','n']);//Garbage Disposal
            $table->enum('backyard_pit',['y','n']);//Garbage Disposal
            $table->enum('open_dump',['y','n']);//Garbage Disposal
            $table->enum('composting',['y','n']);//Garbage Disposal
            $table->enum('burning',['y','n']);//Garbage Disposal
            $table->string('others_garbage_disposal');//Garbage Disposal
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
        Schema::dropIfExists('environment_infos');
    }
}
