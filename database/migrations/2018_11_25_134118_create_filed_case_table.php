<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiledCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filed_case', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_serial_case_num');
            $table->integer('control_no_case');
            $table->string('respondent_case');
            $table->string('nature_of_case');
            $table->string('complainant_case');
            $table->date('date_filed_case');
            $table->enum('action_taken_on_settled_case', ['Arbitration', 'Conciliation', 'Mediation']);
            $table->enum('action_taken_on_unsettled_case', ['repudiation', 'withdrawn', 'pending case', 'case dismissed', 'case certified', 'referred to concerned agencies']);
            $table->string('remarks_case');
                $table->integer('form_id')->unsigned();
                $table->integer('mem_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('filed_case', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filed_case');
    }
}
