<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('education', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->enum('education_type', ['Preschool', 'Primary', 'Secondary', 'Vocational', 'College', 'Post-graduate'])->nullable();
            $table->integer('education_number')->nullable();
            $table->enum('sports_type', ['Covered Court', 'Gymnasium', 'Parks/Plaza', 'Other sports facilities', 'Recreational Activities'])->nullable();
            $table->integer('sports_number')->nullable();
            $table->integer('total_facilities')->nullable();
            $table->timestamps();
            $table->unsignedInteger('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
