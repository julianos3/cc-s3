<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_file', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('contract');
            $table->string('name');
            $table->string('file');
            $table->string('extension');
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
        Schema::drop('contract_file');
    }
}
