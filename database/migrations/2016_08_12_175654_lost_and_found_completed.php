<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LostAndFoundCompleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_and_found_completed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lost_and_found_id')->unsigned();
            $table->foreign('lost_and_found_id')->references('id')->on('lost_and_found');
            $table->integer('user_condominium_id')->unsigned();
            $table->foreign('user_condominium_id')->references('id')->on('users_condominium');
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
        Schema::drop('lost_and_found_completed');
    }
}
