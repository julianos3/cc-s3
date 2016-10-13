<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_role_id')->unsigned();
            $table->foreign('user_role_id')->references('id')->on('users_roles');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum("sex",['m','f'])->default('m');
            $table->string('phone');
            $table->string('iugu_id')->nullable();
            $table->string('password', 60);
            $table->enum("active",['y','fn'])->default('y');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
