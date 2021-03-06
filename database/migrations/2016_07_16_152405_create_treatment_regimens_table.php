<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentRegimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_regimens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('patientId');
            $table->integer('treatmentPackageId')->unsigned();
            $table->boolean('status');
            $table->string('therapist');
            $table->date('createdDate');
            $table->date('updatedDate');
            $table->string('note');
            $table->boolean('active')->default(1);
            $table->string('createdBy');
            $table->string('updatedBy');
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
        Schema::drop('treatment_regimens');
    }
}
