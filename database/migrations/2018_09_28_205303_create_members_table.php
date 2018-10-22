<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('family_name', 50);
            $table->string('middle_name', 50);
            $table->integer('age');
            $table->enum('sex', ['female', 'male']);
            $table->timestamps();
//            $table->unsignedInteger('household_id');
//            $table->foreign('household_id')->references('id')->on('households');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
