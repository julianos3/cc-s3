<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceCompletedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_completed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('maintenance_id')->unsigned();
            $table->foreign('maintenance_id')->references('id')->on('maintenance');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->date('date');
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
        Schema::drop('maintenance_completed');
    }
}
