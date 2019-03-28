<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('households', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('house_number');
            $table->string('barangay');
            $table->string('email_address');
            $table->integer('purok');
            $table->string('place_of_origin');
            $table->integer('mobile_number');
            $table->string('street');
            $table->enum('ethnic_group',['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano','N/A']);
            $table->string('telephone_no');
            $table->enum('status_of_ownership-house',['Owned','Rented','Caretaker','Others']);//housing
            $table->enum('status_of_ownership-lot',['Owned','Rented','Caretaker','Others']);//housing
            $table->enum('type_of_dwelling',['Permanent Concrete','Semi Permanent','Temporary']);//housing
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('households');
    }
}
