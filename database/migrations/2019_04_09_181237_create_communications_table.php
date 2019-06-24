<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('communications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('telephone_totalProvider');
            $table->enum('telephone_name_company', ['PLDT','Globe','Smart','Sky']);
            $table->integer('telephone_no_hhold_served');
            $table->integer('cellular_totalProvider');
            $table->enum('cellular_name_company', ['Smart','Globe','Sun']);
            $table->integer('cellular_no_hhold_served');
            $table->integer('internet_totalProvider');
            $table->enum('internet_name_company', ['PLDT','Globe','Smart','Sky']);
            $table->integer('internet_no_hhold_served');
            $table->integer('postalservive_totalProvider');
            $table->enum('postalservive_name_company', ['Philippine Postal Corporation']);
            $table->integer('postalservive_no_hhold_served');
            $table->integer('deliveryservice_totalProvider');
            $table->enum('deliveryservice_name_company', ['LBC']);
            $table->integer('deliveryservice_no_hhold_served');
            $table->timestamps();
            $table->unsignedInteger('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communications');
    }
}
