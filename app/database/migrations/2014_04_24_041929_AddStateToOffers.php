<?php

use Illuminate\Database\Migrations\Migration;

class AddStateToOffers extends Migration {

	//Agregar (o remover) la columna del estado al que pertenece la oferta
	public function up()
	{
		Schema::table('offers', function($table){
			$table->integer('state_id')->nullable();
		});
	}

	public function down()
	{
		Schema::table('offers', function($table){
			$table->dropColumn('state_id');
		});
	}

}