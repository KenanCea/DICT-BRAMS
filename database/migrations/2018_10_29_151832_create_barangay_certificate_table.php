<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_certificate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('control_no_cert');
            $table->string('purpose_brgy_cert');
            $table->date('barangay_date_issued_cert');
            $table->integer('ctc_no_cert');
            $table->string('ctc_issued_at_cert');
            $table->date('ctc_issued_on_cert');
            $table->integer('official_receipt_no_cert');
            $table->double('amount_paid_cert');
                $table->integer('mem_id')->unsigned();
                $table->integer('official_no')->unsigned();
                $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('barangay_certificate', function (Blueprint $table) {
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
        Schema::dropIfExists('barangay_certificate');
    }
}
