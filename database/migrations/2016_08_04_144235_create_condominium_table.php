<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondominiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominium', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('finality_id')->unsigned();
            $table->foreign('finality_id')->references('id')->on('finality');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city');
            $table->string('name');
            $table->string('zip_code', 9);
            $table->string('address');
            $table->string('number');
            $table->string('district');
            $table->string('complement');
            $table->string('cnpj', 30);
            $table->string('address_site');
            $table->enum('active',['y','n'])->default('y');
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
        Schema::drop('condominium');
    }
}
