<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Called extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('called', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condominium_id')->unsigned();
            $table->foreign('condominium_id')->references('id')->on('condominium');
            $table->integer('user_condominium_id')->unsigned();
            $table->foreign('user_condominium_id')->references('id')->on('users_condominium');
            $table->integer('called_category_id')->unsigned();
            $table->foreign('called_category_id')->references('id')->on('called_category');
            $table->integer('called_status_id')->unsigned();
            $table->foreign('called_status_id')->references('id')->on('called_status');
            $table->string('subject');
            $table->text('description');
            $table->enum('visible', ['y','n'])->default('n');
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
        Schema::drop('called');
    }
}
