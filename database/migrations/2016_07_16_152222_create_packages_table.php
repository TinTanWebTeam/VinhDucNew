<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note');
            $table->integer('treatmentPackageId');
            $table->boolean('active')->default(1);
            $table->string('createdBy');
            $table->string('upDatedBy');
            $table->timestamps();

//            $table->foreign('TreatmentpackageId')->references('id')->on('treatment_packages')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages');
    }
}
