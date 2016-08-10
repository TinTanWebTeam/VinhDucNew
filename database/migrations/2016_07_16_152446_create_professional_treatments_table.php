<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note');
            $table->integer('locationTreatmentId')->unsigned();
            $table->boolean('active')->default(1);
            $table->string('createdBy');
            $table->string('upDatedBy');
            $table->timestamps();

            $table->foreign('locationTreatmentId')->references('id')->on('location_treatments')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('professional_treatments');
    }
}
