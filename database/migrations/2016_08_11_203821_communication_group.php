<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommunicationGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_id')->unsigned();
            $table->foreign('communication_id')->references('id')->on('communication');
            $table->integer('group_condominium_id')->unsigned();
            $table->foreign('group_condominium_id')->references('id')->on('group_condominium');
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
        Schema::drop('communication_group');
    }
}
