<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockNomemclatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_nomemclature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->enum('active',['y','n'])->default('n');
            $table->enum('type',['n','l'])->default('n');
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
        Schema::drop('block_nomemclature');
    }
}
