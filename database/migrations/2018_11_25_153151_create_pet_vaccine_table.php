<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetVaccineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_vaccine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('control_number_pet');
            $table->string('nameOfPet');
            $table->string('kindOfPet');
            $table->string('breedOfPet');
            $table->date('dateOfVaccine');
            $table->double('amountPaid_vaccinated_pet');
            $table->integer('officialReceipt_vaccination_pet');
            $table->enum('registrationStatus', ['yes', 'no']);
            $table->integer('reg_official_receipt_no');
            $table->date('dateOfRegistration');
            $table->double('amountPaid_registered_pet');
                $table->integer('official_no')->unsigned();
                $table->integer('mem_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('pet_vaccine', function (Blueprint $table) {
            $table->foreign('official_no')->references('id')->on('official')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('pet_vaccine');
    }
}
