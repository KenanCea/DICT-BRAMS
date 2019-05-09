<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('officials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->enum('position', ['Punong Barangay','Barangay Kagawad', 'Barangay Secretary', 'Barangay Treasurer']);
            $table->string('name');
            $table->date('start_term');
            $table->date('end_term'); 
            $table->timestamps();     
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('barangays')->onUpdate('cascade')->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officials');
    }
}
