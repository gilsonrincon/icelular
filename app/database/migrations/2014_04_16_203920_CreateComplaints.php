<?php

use Illuminate\Database\Migrations\Migration;

class CreateComplaints extends Migration {

	//Tabla de reclamaciones
	public function up()
	{
		Schema::create('complaints', function($table){
			$table->increments('id');
			
			$table->integer('review_id');
			$table->string('description');
			$table->string('status');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('complaints');
	}

}