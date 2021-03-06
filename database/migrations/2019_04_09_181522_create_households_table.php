<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('households', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('house_no', 5);
            $table->integer('purok');
            $table->string('street');
            $table->enum('solo_parent', ['no','Death of spouse', 'Imprisonment of spouse of at least 1 year', 'Mental/physical incapacity of spouse', 'Legal or de facto separation from spouse for at least 1 year', 'Abandonment of spouse for at least 1 year', 'Unmarried mother/father who preferred to keep the child instead of others carrying him/her', 'Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD', 'Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','others']); 
            $table->string('solo_parent_others')->nullable();
            $table->date('dateOfSurvey');
            $table->string('placeOfOrigin');
            $table->enum('ethnic_group', ['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano','N/A']);
            $table->string('email_address', 45);
            $table->integer('mobile_no');
            $table->integer('telephone_no');
            $table->enum('dialects', ['Bicolano','Bontoc','Cebuano','English','Ibaloi','Ibanag','Ifugao','Ilocano','Itneg','Kalinga','Kankana-ey','Pampangan','Pangasinan','Tagalog','Waray-waray','Panggalatok','Visaya','Kapangpangan']);
            $table->enum('status_of_ownership-house',['Owned','Rented','Caretaker','Others']);
            $table->string('status_of_ownership-house_others')->nullable();
            $table->enum('status_of_ownership-lot',['Owned','Rented','Caretaker','Others']);
            $table->string('status_of_ownership-lot_others')->nullable();
            $table->enum('type_of_dwelling',['Permanent Concrete','Semi Permanent','Temporary']);
            $table->enum('lighting source', ['Electricity', 'Solar', 'Petromax', 'Kerosene']);
            $table->enum('sources_of_info', ['Television', 'Radio', 'Newspaper','Others']);
            $table->string('sources_of_info_others')->nullable();
            $table->enum('communication_services', ['Cell sites/Net', 'Internet', 'Telephone', 'Postal services','others']);
            $table->string('communication_services_others')->nullable();
            $table->enum('means_of_transportation', ['PU jeep', ' Taxi', 'Tricycle', 'PU bus', 'Private car','others']);
            $table->string('means_of_transportation_others')->nullable();
            $table->integer('archive')->default(0);
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');  
            $table->timestamp('deleted_at')->nullable();
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
