<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInhabitantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('inhabitants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id', true);
            $table->string('last_name', 20);
            $table->string('first_name', 25);
            $table->string('middle_name', 20);
            $table->enum('relation_to_the_head', ['The Head', 'Aunt', 'Uncle', 'Brother-in-law', 'Brother', 'Daughter-in-law', 'Daughter', 'Son', 'Son-in-law', 'Sister', 'Sister-in-law', 'Father', 'Mother', 'Grandfather', 'Grandmother', 'Husband', 'Wife', 'Tenant', 'Househelper', 'Common law wife']);
            $table->enum('sex', ['female', 'male']);
            $table->date('date_of_birth');
            $table->string('placeOfBirth_native');
            $table->enum('civil_status', ['Single', 'Married', 'Widow/er', 'Separated', 'Common-law', 'Complicated']);
            $table->enum('religion', ['Aglipayan', 'Anglican', 'Apostolic Christian', 'Assembly of God', 'Baptist', 'Church of Christ', 'Born Again Christian', 'Iglesia ni Cristo', 'Islam', 'Saksi ni Jehovah', 'Seventh Day Adventist', 'Methodist', 'Mormons', 'Pentecost', 'Protestant', 'Roman Catholic']);
            $table->enum('schooling', ['n/a', 'In School', 'Out of School', 'Not yet in school', 'Graduate']);
            $table->enum('Highest_educational_attainment', ['Elem. Graduate', 'Elementary', 'High school undergraduate', 'High school', 'College undergraduate', 'College graduate', 'Vocational', 'Post Graduate', 'Pre-school', 'Not yet attending school']);
            $table->double('Final_family_income', 10)->nullable();
            $table->double('Total_family_income', 10)->nullable();
            $table->enum('status_of_residency', ['Permanent', 'Live-in relative', 'Boarder', 'Buss resident', 'Moved out', 'Deceased']);
            $table->integer('no_of_years_in_barangay');
            $table->date('date_settled_in_barangay');
            $table->enum('citizenship', ['Filipino']);
            $table->enum('ethnicGroup', ['Bago', 'Bicol', 'Bisaya', 'Boholano', 'Bontoc', 'Capizeno', 'Cuyunon', 'Ibaloi', 'Ilonggo', 'Ifugao', 'Ilocano', 'Ivatan', 'Kalinga', 'Kankana-ey', 'Kapangpangan', 'Maguindanao', 'Maranao', 'Masbateno', 'Pangasinan', 'Surigaoan', 'Tagalog', 'Tausog', 'Waray', 'Yakan', 'Zamboagueno/Chavacano']);
            $table->enum('registeredVoterOfTheBrgy', ['yes', 'no']);
            $table->enum('pregnant', ['n/a', 'y']);
            $table->date('expected_date')->nullable();
            $table->enum('blood_type', ['A', 'B', 'AB', 'O', 'Do not know']);
            $table->enum('disability', [
                'None', 'Total blindness of one eye', 'Total blindness of both eye', 'Missing one or both arms', 'Mongoloid', 'Cleff Palate', 'Malabo ang paningin/poor eyesight', 'Hunchback', 'Paralyzed legs', 'Paralyzed arms', 'Speech disorder', 'Authistic', 'Fractured Vertebrate column', 'Paralyzed from neck down', 'Hydrocephalus',
                'Deaf', 'Mute and Deaf', 'Inability to walk alone', 'Deformity', 'Polio', 'Mental Impairment', 'Celebral Palsy', 'Epileptic', 'Dwarfism', 'Others'
            ]);
            $table->string('dissability_others')->nullable();
            $table->string('remarks')->nullable();
            $table->string('specific_job_description');
            $table->enum('gen_job_description', [
                'n/a', 'Accountant', 'Architect', 'Barangay Official', 'Businessman', 'Doctor', 'Engineer', 'Fireman', 'Government office worker', 'IT Worker', 'Lawyer', 'Librarian', 'Manager/Supervisor', 'Missionary', 'Nurse',
                'OFW', 'Pharmacist', 'Policemen', 'Priest', 'Professor/Instructor', 'Preacher/Pastor', 'Researcher', 'Soldier', 'Seafarer', 'Teacher', 'Therapist', 'Call center agent', 'Caregiver', 'Carpenter', 'Caretaker', 'Cashier/clerk', 'Construction worker', 'Cosmetologist/Beautician',
                'Dispatcher/Barker', 'Driver', 'Electrician', 'Factory Worker', 'Farmer/Gardener', 'Helper/Aide', 'Laborer', 'Laundrywoman', 'Machinist', 'Mechanic', 'Mason', 'Mine Worker', 'Porter', 'Plumber', 'Salesperson', 'Security Guard', 'Secretary', 'Service Crew', 'Student Assistance', 'Tailor/Sewer/Dressmaker',
                'Technician', 'Vendor', 'Volunteer Woker', 'Welder'
            ]);
            $table->enum('employment_status', ['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired', 'Unknown']);
            $table->enum('job_category', ['Offical Government and Special Interest', 'Professional', 'Technicians and Assoc. Professional', 'Clerks', 'Service Workers & Market sales workers', 'Farmers & Forestry Workers', 'Trades & related workers', 'Machine Operators/Assemblers', 'Laborers & skilled workers', 'Special Occupations', 'n/a']);
            $table->enum('employment_category', ['Private', 'Government', 'Self employed', 'Overseas']);
            $table->double('estimated_monthly_income_cash', 10);
            $table->string('estimated_monthly_income_kind');
            $table->string('childs_parent_guardian', 50);
            $table->enum('bcg', ['y', 'n']);
            $table->enum('dpi1', ['y', 'n']);
            $table->enum('dpi2', ['y', 'n']);
            $table->enum('dpi3', ['y', 'n']);
            $table->enum('opd1', ['y', 'n']);
            $table->enum('opd2', ['y', 'n']);
            $table->enum('opd3', ['y', 'n']);
            $table->enum('measles', ['y', 'n']);
            $table->enum('others1', ['y', 'n']);
            $table->enum('others2', ['y', 'n']);
            $table->enum('others3', ['y', 'n']);
            $table->double('weight', 5);
            $table->double('height', 5);
            $table->date('date_measured_height_weight');
            $table->enum('dewormed', ['yes', 'no']);
            $table->enum('received_vitaminA', ['yes', 'no']);
            $table->string('ip');
            $table->timestamps();
            $table->unsignedInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('inhabitants');
    }
}
