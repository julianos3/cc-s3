<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupCondominiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_group_condominium', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_condominium_id')->unsigned();
            $table->foreign('user_condominium_id')->references('id')->on('users_condominium');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('group_condominium');
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
        Schema::drop('users_group_condominium');
    }
}
