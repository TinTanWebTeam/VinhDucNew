<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patientId')->unsigned();
            $table->string('reasons');
            $table->string('pathologicalProcess');
            $table->string('anamnesis');
            $table->string('body');
            $table->string('parts');
            $table->string('pulse');
            $table->string('temperature');
            $table->string('bloodPressure');
            $table->string('breathing');
            $table->string('weight');
            $table->string('height');
            $table->string('subclinical');
            $table->boolean('active')->default(1);
            
            $table->timestamps();

            $table->foreign('patientId')->references('id')->on('patient_managements')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medical_records');
    }
}
