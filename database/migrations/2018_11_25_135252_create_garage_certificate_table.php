<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarageCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garage_certificate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('control_no_garage');
            $table->enum('designated_of_garage', ['yes', 'no']);
            $table->string('location_garage');
            $table->string('engine_number_garage');
            $table->integer('body_number_garage');
            $table->string('lto_OR_number_garage');
            $table->string('garage_photo')->nullable();
            $table->date('date_issued_garage');
            $table->integer('barangay_Official_receipt_no_garage');
            $table->double('amount_paid_garage');
            $table->integer('ctc_no_garage');
            $table->date('ctc_issued_on_garage');
            $table->string('ctc_issued_at_garage');
                $table->integer('form_id')->unsigned();
                $table->integer('mem_id')->unsigned();
                $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('garage_certificate', function (Blueprint $table) {
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
        Schema::dropIfExists('garage_certificate');
    }
}
