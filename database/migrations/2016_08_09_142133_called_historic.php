<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalledHistoric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('called_historic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('called_id')->unsigned();
            $table->foreign('called_id')->references('id')->on('called');
            $table->integer('user_condominium_id')->unsigned();
            $table->foreign('user_condominium_id')->references('id')->on('users_condominium');
            $table->integer('called_status_id')->unsigned();
            $table->foreign('called_status_id')->references('id')->on('called_status');
            $table->text('description');
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
        Schema::drop('called_historic');
    }
}
