<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayIdCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_id_card', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('control_no_card');
            $table->date('date_applied_card');
            $table->double('amount_paid_card');
            $table->integer('brg_OR_no_card');
            $table->date('date_card_issued_card');
            $table->date('year_applied');
            $table->string('contact_person_card');
            $table->string('address_contact_person_card');
            $table->integer('cp#_contact_person_card');
            $table->integer('cp#_cardholder_card');
                $table->integer('mem_id')->unsigned();
                $table->integer('official_no')->unsigned();
                $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('barangay_id_card', function (Blueprint $table) {
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('official_no')->references('id')->on('official')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangay_id_card');
    }
}
