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
            $table->string('patientId');
            $table->string('reasons');
            $table->string('pathologicalProcess');
            $table->string('anamnesis');
            $table->string('parts');
            $table->string('body');
            $table->string('subclinical');
            $table->boolean('active')->default(1);
            
            $table->timestamps();

            $table->foreign('patientId')->references('code')->on('patient_managements')->onDelete('no action');
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
