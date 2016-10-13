<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LostAndFound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_and_found', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condominium_id')->unsigned();
            $table->foreign('condominium_id')->references('id')->on('condominium');
            $table->integer('user_condominium_id')->unsigned();
            $table->foreign('user_condominium_id')->references('id')->on('users_condominium');
            $table->string('name');
            $table->text('description');
            $table->dateTime('date');
            $table->enum('found',['y', 'n']);
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
        Schema::drop('lost_and_found');
    }
}
