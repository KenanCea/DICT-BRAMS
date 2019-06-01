<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiledcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('filedcases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('complainants');
            $table->string('complain');
            $table->string('relief');
			$table->string('place_of_birth');
			$table->string('address');
            $table->integer('control_no');
            $table->string('respondent', 50);
            $table->enum('case',['Collecting sum of money','Estafa','Malicius Mischief','Physical Injury','Physical Injury with Robbery','Theft','Threat','Unjust Vexation','Murder','Rape','Children in Conflict of the law']);
            $table->string('type_of_case');
            $table->string('complainant', 45);
            $table->string('co_complainant', 45);
            $table->date('date_filed');
            $table->enum('action_taken_on_settled', ['Arbitration', 'Conciliation', 'Mediation']);
            $table->enum('action_taken_on_unsettled', ['Repudiation', 'Withdrawn', 'Pending case', 'Case dismissed', 'Case certified', 'Referred to concerned agencies']);
            $table->string('remarks');
            $table->timestamps();
            $table->integer('inhabitant_id')->unsigned();
            $table->foreign('inhabitant_id')->references('id')->on('inhabitants')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filedcases');
    }
}
