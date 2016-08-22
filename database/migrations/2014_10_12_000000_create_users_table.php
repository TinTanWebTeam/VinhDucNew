<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('fullName');
            $table->string('password');
            $table->string('createdBy');
            $table->string('upDatedBy');
            $table->boolean('active')->default(1);
            $table->integer('roleId')->unsigned();
            $table->integer('positionId')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('roleId')->references('id')->on('roles')->onDelete('no action');
            $table->foreign('positionId')->references('id')->on('positions')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
