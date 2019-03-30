<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInhabitantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inhabitants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('household_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('relation_to_the_head', ['THE HEAD', 'Aunt', 'Brother-in-law', 'Brother', 'Daugther-in-law', 'Daughter', 'Father', 'Grandfather', 'Grandmother', 'Househelper', 'Husband', 'Mother', 'Son', 'Son-in -law', 'Sister-in-law', 'Tenant', 'Uncle', 'Wife', 'Common law wife']);
            $table->enum('employment_category', ['Private', 'Government', 'Self employed', 'Overseas']);
            $table->enum('sex', ['Male', 'Female']);
            $table->string('est_monthly_income_cash');
            $table->string('date_of_birth');
            $table->enum('est_monthly_income_kind', ['Rice', 'Vegetables', 'Free rental', 'City services']);
            $table->string('total_family_income');
            $table->enum('civil_status', ['Single', 'Married', 'Widow/er', 'Separated', 'Common-Law', 'Complicated']);
            $table->integer('final_family_income');
            $table->enum('religion', ['Aglipayan', 'Anglican', 'Apostolic Christian', 'Assembly of God', 'Baptist', 'Church of Christ', 'Born Again Christian', 'Iglesia ni Cristo', 'Islam', 'Saksi ni Jehovah', 'Seventh Day Adventist', 'Methodist', 'Mormons', 'Pentecost', 'Protestant', 'Roman Catholic']);
            $table->enum('status_of_residency', ['Permanent', 'Live-in relative', 'Boarder', 'Buss Resident', 'Moved Out', 'Deceased']);
            $table->enum('schooling', ['In school', 'Out of school', 'Not yet in school', 'Graduate']);
            $table->integer('no_of_years_in_barangay');
            $table->enum('highest_educ_attainment', ['Elementary undergraduate', 'Elementary', 'High school undergraduate', 'High school', 'College undergraduate', 'College Graduate', 'Vocational', 'Post Graduate', 'Pre-school', 'Not yet attending school']);
            $table->string('date_settled_in_the_barangay');
            $table->string('specific_job_description');
            $table->enum('citizenship', ['Filipino']);
            $table->enum('gen_job_description', ['Security Guard', 'Secretary', 'Service Crew', 'Student Assistant', 'Tailor/Sewer/Dressmaker', 'Technician', 'Vendor', 'Volunteer Woker', 'Welder', 'none', 'n/a']);
            $table->enum('employment_status', ['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired']);
            $table->enum('ethnic_group', ['Bago', 'Bicol', 'Bisaya', 'Boholano', 'Bontoc', 'Capizeno', 'Cuyunon', 'Ibaloi', 'Ilonggo', 'Ifugao', 'Ilocano', 'Ivatan', 'Kalinga', 'Kapangpangan', 'Maguindanao', 'Maranao', 'Masbateno', 'Pangasinan', 'Surigaoan', 'Tagalog', 'Tausog', 'Waray', 'Yakan', 'Zamboagueno/Chavacano']);
            $table->enum('job_category', ['Offical Government and Special Interest', 'Professional', 'Technicians and Assoc. Professional', 'Clerks', 'Service Workers & Market sales workers', 'Farmers & Forestry Workers', 'Trades & related workers', 'Machine Operators/Assemblers', 'Laborers & skilled workers', 'Special Occupations', 'n/a']);
            $table->string('place_of_birth');
            $table->enum('registered_voter', ['Yes', 'No']);
            $table->string('child_parent');
            $table->integer('weight');
            $table->integer('height');
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
        Schema::dropIfExists('inhabitants');
    }
}
