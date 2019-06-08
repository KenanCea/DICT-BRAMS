<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints(); 
        Schema::create('household_distributions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('total_no_hhold' );
            $table->integer('ave_persons_hhold');
            $table->double('ave_income_hhold', 10);
            $table->string('rank1_employment');
            $table->string('rank2_employment');
            $table->string('rank3_employment');
            $table->timestamps();
            $table->unsignedInteger('landuse_id');
            $table->foreign('landuse_id')->references('id')->on('landuses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household_distributions');
    }
}
