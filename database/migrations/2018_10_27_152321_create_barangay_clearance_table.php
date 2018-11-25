<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayClearanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_clearance', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('control_no_clearance');
            $table->string('business_address_clearance');
            $table->string('business_tradename_clearance');
            $table->string('purpose_brgy_clearance');
            $table->date('date_issued_clearance');
            $table->integer('brgy_official_receipt_no_clearance');
            $table->integer('ctc_no_clearance');
            $table->date('ctc_issued_on_clearance');
            $table->string('ctc_issued_at_clearance');
                $table->integer('mem_id')->unsigned();
                $table->integer('official_no')->unsigned();
                $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('barangay_clearance', function (Blueprint $table) {
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
        Schema::dropIfExists('barangay_clearance');
    }
}
