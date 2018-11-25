<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmunizedChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunized_children', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type_immunized_children', ['Vitamin A', ' Deworm', ' Hep B', 'MMR1', 'BCG', 'MMr2']);
            $table->enum('penta', ['6th week', '10th week', '14th week']);
            $table->enum('opv', ['6th week', '10th week', '14th week']);
            $table->enum('ipv', ['6th week', '10th week', '14th week']);
            $table->enum('pcv_13', ['6th week', '10th week', '14th week']);
                $table->integer('health_id')->unsigned();
                $table->integer('mem_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('immunized_children', function (Blueprint $table) {
            $table->foreign('health_id')->references('id')->on('health_info')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immunized_children');
    }
}
