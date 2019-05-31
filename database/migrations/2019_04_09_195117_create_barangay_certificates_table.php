<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('barangay_certificates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('name');
			$table->integer('age');
			$table->string('citizenship');
			$table->string('barangay');
			$table->string('postal_address');
            $table->integer('control_no');
            $table->string('purpose');
            $table->date('date_issued');
            $table->integer('ctc_no');
            $table->string('ctc_issued_at');
            $table->date('ctc_issued_on');
            $table->integer('official_receipt_no');
            $table->double('amount_paid', 5);
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
        Schema::dropIfExists('barangay_certificates');
    }
}
