<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condominium_id')->unsigned();
            $table->foreign('condominium_id')->references('id')->on('condominium');
            $table->string("name");
            $table->enum('active', ['y','n'])->default('n');
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
        Schema::drop('reserve_areas');
    }
}
