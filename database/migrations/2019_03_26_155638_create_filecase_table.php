<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilecaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filecases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_serial_case_num');
            $table->integer('control_no_case');
            $table->string('respondent_case');
            $table->string('nature_of_case');
            $table->string('complainant_case');
            $table->date('date_filed_case');
            $table->enum('action_taken_on_settled_case', ['Arbitration', 'Conciliation', 'Mediation']);
            $table->enum('action_taken_on_unsettled_case', ['repudiation', 'withdrawn', 'pending case', 'case dismissed', 'case certified', 'referred to concerned agencies']);
            $table->string('remarks_case');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filecases');
    }
}
