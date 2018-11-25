<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarbageFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garbage_fee', function (Blueprint $table) {
            $table->increments('id');
            $table->date('datePaid_garbfee');
            $table->integer('brgy_order_garbfee');
            $table->double('total_amt_paid_garbfee');
            $table->integer('city_order_garbfee');
            $table->double('amt_pd_citytreasurer_garbfee');
            $table->double('application_payment');
                $table->integer('form_id')->unsigned();
                $table->integer('mem_id')->unsigned();
                $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('garbage_fee', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garbage_fee');
    }
}
