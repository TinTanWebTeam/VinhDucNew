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
            $table->integer('treatmentPackageId')->unsigned();
            $table->integer('patientId')->unsigned();
            $table->integer('professionalTreatmentId')->unsigned();
            $table->integer('therapistId')->unsigned();
            $table->boolean('ail')->default(0);
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
