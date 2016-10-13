<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsefulPhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useful_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condominium_id')->unsigned();
            $table->foreign('condominium_id')->references('id')->on('condominium');
            $table->string('name');
            $table->string('phone');
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
        Schema::drop('useful_phones');
    }
}
