<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('information_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->date('createdDate');
            $table->boolean('active')->default(1);
            $table->string('patientReviews');
            $table->integer('patient_id')->unsigned();
            $table->integer('therapist_id')->unsigned();
            $table->string('question');
            $table->boolean('handling');
            $table->string('createdBy');
            $table->string('upDatedBy');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient_managements');
            $table->foreign('therapist_id')->references('id')->on('detailed_treatments');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('information_surveys');
    }
}
