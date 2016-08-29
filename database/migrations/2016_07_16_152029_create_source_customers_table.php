<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sourceCustomer')->unique();
            $table->boolean('active')->default(1);
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
        Schema::drop('source_customers');
    }
}
