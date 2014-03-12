<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('offers', function(Blueprint $table)
		{
			$table->string('title')->aftert('product_id'); //título para la oferta (complementario al nombre del producto)
			$table->text('description')->after('title'); //descripción general del producto, definida por la tienda
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('offers', function(Blueprint $table)
		{
			$table->dropColumn('description');
			$table->dropColumn('title');
		});
	}

}