<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name_form');
                $table->integer('official_no')->unsigned();
                $table->integer('mem_id')->unsigned();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->foreign('official_no')->references('id')->on('official')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('forms');
    }
}
