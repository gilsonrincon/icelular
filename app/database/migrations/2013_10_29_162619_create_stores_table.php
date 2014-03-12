<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stores', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('name');
			$table->text('short_description');
			$table->text('description');
			$table->text('email');
			$table->string('logo');
			$table->string('url');
			$table->string('fan_page');
			$table->string('twitter');
			$table->string('google_plus');
			$table->string('youtube');
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stores');
	}

}
