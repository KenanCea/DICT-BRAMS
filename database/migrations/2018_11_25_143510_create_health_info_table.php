<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_info', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('common_illness', ['Diarrhea', 'Mumps', 'Chickenpox', 'UTI']);
            $table->string('common_illness_others')->nullable();
            $table->enum('facilities/services', ['government hospital', 'private hospital', 'health center', 'private doctor', 'hilot']);
            $table->enum('disability', ['yes', 'no']);
            $table->enum('disability_yes', ['total blindness of one eye', 'total blindness of both eyes', 'missing one or both arms', 'mongoloid', 'cleff palate', 'poor eyesight', 'hunchback', 'paralyzed legs', 'paralyzed arms', 'speech disorder', 'autistic', 'fractured vertebrate column', 'paralyzed from neck down', 'hydrocephalus', 'deaf', 'mute and deaf', 'inablity to walk alone', 'deformity', 'polio', 'mental impairment', 'celebral', 'palsy', 'epileptic', 'dwarfism', 'others'])->nullable();
            $table->enum('pregnancy', ['yes', 'no']);
            $table->enum('family_planning', ['yes', 'no']);
            $table->enum('family_planning_yes', ['condom', 'diaphragm', 'body temperature', 'injectibles', 'iud', 'ligation', 'pills', 'rhythm', 'mucus', 'natural', 'vasectomy', 'withdrawal'])->nullable();
            $table->enum('go/ngo-assistance', ['yes', 'no']);
            $table->string('go/ngo-assistance_yes')->nullable();
                $table->integer('mem_id')->unsigned();
                $table->integer('hhold_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('health_info', function (Blueprint $table) {
            $table->foreign('mem_id')->references('id')->on('members')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('hhold_id')->references('id')->on('household')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_info');
    }
}
