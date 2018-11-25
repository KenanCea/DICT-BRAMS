<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('pre-school', ['graduate', 'undergraduate', 'currently enrolled']);
            $table->enum('primary_elementary', ['graduate', 'undergraduate', 'currently enrolled']);
            $table->enum('secondary_highschool', ['graduate', 'undergraduate', 'currently enrolled']);
            $table->enum('vocational', ['graduate', 'undergraduate', 'currently enrolled']);
            $table->enum('college', ['graduate', 'undergraduate', 'currently enrolled']);
            $table->enum('post_graduate', ['graduate', 'undergraduate', 'currently enrolled']);
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('school', function (Blueprint $table) {
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
        Schema::dropIfExists('school');
    }
}
