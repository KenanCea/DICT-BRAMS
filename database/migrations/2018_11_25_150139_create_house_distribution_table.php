<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseDistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_distribution', function (Blueprint $table) {
            $table->increments('id');
            $table->double('total_hhold_3yrs');
            $table->double('ave_hhold_3yrs');
            $table->double('ave_hhold_income_3yrs');
                $table->integer('hhold_id')->unsigned();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('house_distribution', function (Blueprint $table) {
            $table->foreign('hhold_id')->references('id')->on('household')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('barangay_id')->references('id')->on('barangayProfile')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_distribution');
    }
}
