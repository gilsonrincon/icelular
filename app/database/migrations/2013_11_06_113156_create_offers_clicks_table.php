<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersClicksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers_clicks', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('offer_id')->unsigned();
			$table->string('ip')->default('0.0.0.0');
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
		Schema::drop('offers_clicks');
	}

}
