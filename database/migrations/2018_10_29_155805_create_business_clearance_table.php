<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessClearanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('business_clearance', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('control_no_busclearance');
            $table->string('business_address_busclearance');
            $table->string('business_trade_name_busclearance');
            $table->enum('business_application_busclearance', ['new', 'renewal']);
            $table->string('kind_business_busclearance');
            $table->string('line_of_business_busclearance');
            $table->enum('business_approv_disaprov_busclearance', ['approval', 'disapproval']);
            $table->string('reasons_approv_disapprove_busclearance');
            $table->date('date_issued_busclearance');
            $table->integer('ctc_no_busclearance');
            $table->date('ctc_issued_on_busclearance');
            $table->string('ctc_issued_at_busclearance');
            $table->integer('brgy_official_receipt_no_busclearance');
            $table->date('date_OfficialReceipt_busclearance');
            $table->double('total_amt_paid_busclearance');
            $table->enum('business_Industry', ['Agriculture', 'Construction', 'Electricity/gas and water', 'wholesale', 'retail, and trade', 'Transport', 'storage', 'communications', 'Community', 'Social and personal services', 'Financing', ' Insurance', 'Real States', 'Manufacturing', 'Mining']);
                $table->integer('mem_id')->unsigned();
                $table->integer('official_no')->unsigned();
                $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('business_clearance', function (Blueprint $table) {
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
        Schema::dropIfExists('business_clearance');
    }
}
