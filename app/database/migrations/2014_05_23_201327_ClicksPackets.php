<?php

use Illuminate\Database\Migrations\Migration;

class ClicksPackets extends Migration {

	//Paquetes de clicks
	public function up()
	{
		Schema::create('clicks_packets', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('value');
			$table->timestamps();
		});
	}

	//Boorrar la tabla de paquetes de clicks
	public function down()
	{
		Schema::drop('clicks_packets');
	}

}