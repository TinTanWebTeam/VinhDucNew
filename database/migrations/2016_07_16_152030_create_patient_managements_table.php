<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('fullName');
            $table->date('birthday');
            $table->boolean('sex');
            $table->string('job');
            $table->string('phone');
            $table->string('address');
            $table->string('hoursMinuteTo');
            $table->date('dateMonthYearTo');
            $table->string('where');
            $table->string('timeGoIn');
            $table->integer('provincialId')->unsigned();
            $table->integer('age');
            $table->boolean('active')->default(1);
            $table->string('createdBy');
            $table->string('upDatedBy');

            $table->timestamps();

            $table->foreign('provincialId')->references('id')->on('provinces')->onDelete('no action');
           


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_managements');
    }
}
