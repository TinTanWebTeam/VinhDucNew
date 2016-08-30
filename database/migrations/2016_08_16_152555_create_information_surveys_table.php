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
            $table->string('patient_id');
            $table->string('content');
            $table->boolean('handling');
            $table->string('createdBy');
            $table->string('upDatedBy');
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
        Schema::drop('information_surveys');
    }
}
