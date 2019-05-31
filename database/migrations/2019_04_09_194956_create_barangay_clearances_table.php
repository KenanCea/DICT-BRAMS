<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangayClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('barangay_clearances', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('name');
			$table->integer('age');
			$table->string('citizenship');
			$table->string('place_of_birth');
			$table->string('address');
            $table->integer('control_no');
            $table->integer('ctc_no');
            $table->string('purpose_of_clearance');
            $table->date('date_issued');
            $table->integer('official_receipt_no');
            $table->date('ctc_issued_on');
            $table->string('ctc_issued_at');
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
        Schema::dropIfExists('barangay_clearances');
    }
}
