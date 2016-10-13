<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCondominiumTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_condominium', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('user_role_condominium')->unsigned();
			$table->foreign('user_role_condominium')->references('id')->on('users_roles_condominium');
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
		Schema::drop('users_condominium');
	}

}
