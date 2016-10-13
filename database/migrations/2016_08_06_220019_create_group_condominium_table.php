<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupCondominiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_condominium', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('condominium_id')->unsigned();
            $table->foreign('condominium_id')->references('id')->on('condominium');
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
        Schema::drop('group_condominium');
    }
}
