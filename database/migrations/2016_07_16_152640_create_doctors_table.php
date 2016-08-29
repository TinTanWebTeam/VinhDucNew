<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->boolean('sex');
            $table->string('note');
            $table->integer('ageId')->unsigned();
            $table->integer('provincialId')->unsigned();
            $table->boolean('active')->default(1);
            $table->string('createdBy');
            $table->string('upDatedBy');

            $table->timestamps();

            $table->foreign('provincialId')->references('id')->on('provinces')->onDelete('no action');
            $table->foreign('ageId')->references('id')->on('ages')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctors');
    }
}
