<?php

use Illuminate\Database\Migrations\Migration;

class AddUserIdToStores extends Migration {

	//Agregar el campo de user_id a la tienda
	public function up()
	{
		Schema::table('stores', function($table){
			$table->integer('user_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stores', function($table){
			$table->dropColumn('user_id');
		});
	}

}