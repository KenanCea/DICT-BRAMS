<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('health_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('born_alived_reg');
            $table->integer('born_dead_reg');
            $table->integer('still_birth_reg');
            $table->integer('born_alived_ureg');
            $table->integer('born_dead_ureg');
            $table->integer('still_birth_ureg');
            $table->date('date_still_birth');
            $table->integer('dead_children_afterbirth');
            $table->integer('dead-adults');
            $table->string('cause_s');
            $table->date('date_dead');
            $table->enum('uri', ['y', 'n']);//Common Illness in the family (Within last 2 weeks)
            $table->enum('diarrhea', ['y', 'n']);//Common Illness in the family (Within last 2 weeks)
            $table->enum('weakness', ['y', 'n']);//Common Illness in the family (Within last 2 weeks)
            $table->enum('underweight', ['y', 'n']);//Common Illness in the family (Within last 2 weeks)
            $table->enum('passing_of_worms', ['y', 'n']);//Common Illness in the family (Within last 2 weeks)
            $table->string('others_common_illness');//Common Illness in the family (Within last 2 weeks)
            $table->enum('government_hospital', ['y', 'n']);//Health Facilities/Services availed of
            $table->enum('private_hospital', ['y', 'n']);//Health Facilities/Services availed of
            $table->enum('health_center', ['y', 'n']);//Health Facilities/Services availed of
            $table->enum('private_doctor', ['y', 'n']);//Health Facilities/Services availed of
            $table->enum('hilot', ['y', 'n']);//Health Facilities/Services availed of
            $table->string('others_health_services');//Health Facilities/Services availed of
            $table->enum('acceptor', ['y', 'n']);//family planning
            $table->enum('family_planning_yes', ['Condom', 'Diaphragm', 'Body temperature', 'Injectibles', 'IUD', 'Ligation', 'Pills', 'Rhythm', 'Mucus', 'Natural', 'Vasectomy', 'Withdrawal'])->nullable();
            $table->string('go_ngo');
            $table->timestamps();
            $table->unsignedInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_infos');
    }
}
