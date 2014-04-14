<?php

use Illuminate\Database\Migrations\Migration;

class AlterToReviews extends Migration {

	//Agregar una columna para el estado de la calificación
	public function up()
	{
		Schema::table('reviews', function($table){
			$table->boolean('status')->nullable();
		});
	}

	public function down()
	{
		Schema::table('reviews', function($table){
			$table->dropColumn('status');
		});
	}

}