<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment_info', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('food_service', ['Market', 'Sari-sari store', ' Ambulant vendor']);
            $table->string('food_service_others')->nullable();
            $table->enum('kind_of_food_storage', ['Fresh', 'Dried', 'Processed']);
            $table->string('kind_of_food_storage_others')->nullable();
            $table->date('garbage_disposal_date');
            $table->string('water_storage_facility');
            $table->enum('household_storage', ['elevated', 'cabinet/shelves']);
            $table->string('household_storage_others')->nullable();
            $table->enum('toilet_facilities', ['Flush with Septic', 'Flush with Sewer', 'Water Sealed', 'Pit privy']);
            $table->enum('drainage_facilities', ['open drainage', 'blind drainage', 'no drainage']);
            $table->enum('garbage_disposal', ['collection system', 'communal pit', 'backyard pit', 'open dump', 'composting', 'burning']);
            $table->string('garbage_disposal_others')->nullable();
                $table->integer('hhold_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('environment_info', function (Blueprint $table) {
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
        Schema::dropIfExists('environment_info');
    }
}
