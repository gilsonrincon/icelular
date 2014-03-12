<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_addressess', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id');
			$table->string('name_address');
			$table->string('country');
			$table->string('state');
			$table->string('city');
			$table->text('address');
			$table->string('phone');
			$table->string('coords_gmaps');
			
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
		Schema::drop('store_addressess');
	}

}
