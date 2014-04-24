<?php

use Illuminate\Database\Migrations\Migration;

class AddMapToStores extends Migration {

	//Agregar la columna map a stores
	public function up()
	{
		Schema::table('stores', function($table){
			$table->text('map')->nullable();
		});
	}

	public function down()
	{
		Schema::table('stores', function($table){
			$table->dropColumn('map');
		});
	}

}