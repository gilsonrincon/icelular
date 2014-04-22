<?php

use Illuminate\Database\Migrations\Migration;

class AlterOffer extends Migration {

	//Agregar el campo de url a la oferta
	public function up()
	{
		Schema::table('offers', function($table){
			$table->string('url')->nullable();
		});
	}

	
	public function down()
	{
		Schema::table('offers', function($table){
			$table->dropColumn('url');
			
		});
	}

}