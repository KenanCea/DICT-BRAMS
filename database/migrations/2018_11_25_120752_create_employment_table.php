<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employment_status');
            $table->enum('general_job_description', ['permanent', 'contractual', 'temporary', 'self-employed', 'retired', 'unknown status']);
            $table->enum('job_category', ['private', 'government', 'self-employed', 'overseas']);
            $table->string('employment_category');
            $table->double('monthly_income_cash');
                $table->integer('mem_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('employment', function (Blueprint $table) {
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
        Schema::dropIfExists('employment');
    }
}
