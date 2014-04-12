<?php

use Illuminate\Database\Migrations\Migration;

class RenameColumnAndAlterToReviews extends Migration {

	//Agregar una columna para el estado de la calificación y cambiar el nombre de la
	//columna product_id a offer_id
	public function up()
	{
		Schema::table('reviews', function($table){
			$table->boolean('status')->nullable();
			$table->renameColumn('product_id', 'offer_id');
		});
	}

	public function down()
	{
		Schema::table('reviews', function($table){
			$table->dropColumn('status');
			$table->renameColumn('offer_id', 'product_id');
		});
	}

}