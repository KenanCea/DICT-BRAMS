<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id', true);
            $table->string('family_name');
            $table->string('first_name');
            $table->string('middle_name'); 
            $table->string('region_barangay');
            $table->string('relation_to_head');
            $table->enum('sex', ['female', 'male']); 
            $table->string('placeOfBirth');
            $table->string('dateOfBirth');
            $table->string('email_add');
            $table->integer('mobile_no');
            $table->integer('telephone_no');
            $table->enum('civilStatus', ['single', 'married', 'widow', 'separated', 'common-law', 'complicated']);
            $table->string('citizenship');
            $table->string('religion');
            $table->string('schooling');
            $table->string('Highest_educational_attainment');
            $table->integer('familyIncome');
            $table->enum('statusOfResidency', ['permanent', 'live-in relative', 'boarder', 'buss resident', 'moved out', 'deceased']);
            $table->string('ethnicGroup');
            $table->double('height');
            $table->double('weight');
            $table->enum('bloodType', ['A', 'B', 'O', 'AB']);
            $table->enum('registeredVoterOfTheBrgy', ['yes', 'no']);
            $table->string('mem_pic');
            $table->integer('previousResidence');
            $table->integer('no_of_months_and_year_living_in_this_brgy');
            $table->string('reason_you_left_in_previous_brgy');
            $table->string('reason_you_came_in_this_brgy');
            $table->integer('until_when_you_stay_in_this_brgy');
            $table->string('who_accompanied_you_to_transfer_here');
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
        Schema::dropIfExists('members');
    }
}

