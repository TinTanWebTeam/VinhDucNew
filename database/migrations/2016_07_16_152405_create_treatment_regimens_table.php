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
            $table->integer('patientId')->unsigned();
            $table->integer('treatmentPackageId')->unsigned();
            $table->boolean('active')->default(1);
            $table->date('createdDate');
            $table->date('updateDate');
            $table->string('note');
            $table->boolean('status')->defailt(0);
            $table->string('createdBy');
            $table->string('updatedBy');
            $table->timestamps();

            $table->foreign('treatmentPackageId')->references('id')->on('treatment_packages')->onDelete('no action');
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
