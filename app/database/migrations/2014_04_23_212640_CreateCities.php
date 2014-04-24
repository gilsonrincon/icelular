<?php

use Illuminate\Database\Migrations\Migration;

class CreateCities extends Migration {

	//Creamos la tabla de ciudades
	public function up()
	{
		Schema::create('cities', function($table){
			$table->increments('id');
			$table->integer('country_id');
			$table->string('name');
			$table->timestamps();
		});
	}

	
	public function down()
	{
		Schema::drop('cities');
	}

}