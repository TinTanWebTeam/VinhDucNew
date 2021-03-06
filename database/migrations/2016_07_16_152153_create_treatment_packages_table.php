<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('note');
            $table->integer('packageId');
            $table->string('patientId');
            $table->boolean('active')->default(1);
            $table->date('createdDate');
            $table->string('codeDoctor');
            $table->integer('umpteenth')->default(0);
            $table->date('updateDate');
            $table->string('createdBy');
            $table->string('upDatedBy');
            $table->timestamps();

            //$table->foreign('packageId')->references('id')->on('packages')->onDelete('no action');
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
        Schema::drop('treatment_packages');
    }
}
