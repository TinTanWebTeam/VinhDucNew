<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailedTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('treatmentPackageId');
            $table->string('patientId');
            $table->string('professionalTreatment');
            $table->string('location');
            $table->string('time');
            $table->integer('sesame');
            $table->integer('minute');
//            $table->string('therapistId');
//            $table->boolean('ail')->default(0);
            $table->string('note');
            $table->boolean('active')->default(1);
            $table->date('createdDate');
            $table->date('updateDate');
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
        Schema::drop('detailed_treatments');
    }
}
