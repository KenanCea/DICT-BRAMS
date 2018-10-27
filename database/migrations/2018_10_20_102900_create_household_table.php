<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('household', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id', true);
            $table->integer('hhold_number');
            $table->enum('solo_parent', ['yes', 'no']);
            $table->enum('solo_parent_yes', ['Death of spouse', 'Imprisonment of spouse at least 1 year', 'Mental/physical incapacity of house', 'Legal or de facto separation from spouse for at least 1 year', 'Abandonment of spouse for at least 1 year', 'Unmarried mother/father who preferred to keep the child instead of others carrying him/her', 'Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD', 'Any family member who assumes the responsibility as head of the family as a result of death', 'Abandonment', 'Absence for at least one year']); 
            $table->string('solo_parent_others');
            $table->integer('purok_hhold');
            $table->string('street'); 
            $table->string('barangay');
            $table->enum('sources_of_info', ['Television', 'Radio', 'Newspaper']);
            $table->string('sources_of_info_specify_others');
            $table->enum('communication_services', ['Cell sites', 'Internet', 'Telephone', 'Postal services']);
            $table->string('communication_services_others');
            $table->enum('energy source', ['Electricity', 'Solar', 'Petromax', 'Kerosene']);
            $table->enum('means of transportation', ['PU jeep', ' Taxi', 'Tricycle', 'PU bus', 'Private car']);
            $table->string('house_pic');
            $table->integer('born_alive_reg');
            $table->date('date_born_reg');
            $table->integer('born_alive_unreg');
            $table->date('date_born_unreg');
            $table->integer('born_dead_reg');
            $table->date('date_dead_reg');
            $table->integer('born_dead_unreg');
            $table->date('date_dead_unreg');
            $table->integer('still_birth_reg');
            $table->date('date_sbirth_reg');
            $table->integer('still_birth_unreg');
            $table->date('date_sbirth_unreg');
            $table->integer('no_dead_child');
            $table->string('cause of death_ch');
            $table->integer('no_of death_ad');
            $table->string('cause of death');
                $table->integer('mem_id')->unsigned();
                $table->integer('barangay_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('household', function (Blueprint $table) {
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('barangay_id')->references('id')->on('barangayProfile')->onUpdate('cascade')->onDelete('cascade');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household');
    }
}
