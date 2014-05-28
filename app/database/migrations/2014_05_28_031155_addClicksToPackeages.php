<?php

use Illuminate\Database\Migrations\Migration;

class AddClicksToPackeages extends Migration {

	//Agregamos el campo del numero de clicks a los paquetes
	public function up()
	{
		Schema::table('clicks_packets', function($table){
			$table->integer('clicks')->nullable();
		});
	}

	public function down()
	{
		Schema::table('clicks_packets', function($table){
			$table->dropColumn('clicks');
		});
	}

}