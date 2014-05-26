<?php

use Illuminate\Database\Migrations\Migration;

class PackeagesPurchased extends Migration {

	//Crear la tabla de paquetes comprados que relaciona los paquetes de clicks con las tiendas
	public function up()
	{
		Schema::create('packeages_purchased', function($table){
			$table->increments('id');
			$table->integer('store_id');
			$table->integer('packeage_id');
			$table->timestamps();
		});
	}

	
	public function down()
	{
		Schema::drop('packeages_purchased');
	}

}