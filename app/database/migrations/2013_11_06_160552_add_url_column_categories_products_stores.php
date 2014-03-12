<?php

use Illuminate\Database\Migrations\Migration;

class AddUrlColumnCategoriesProductsStores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//añade la columna url a la tabla categories
		Schema::table('categories', function($table) {
			$table -> string('url')->after('description');
		});
		
		//añade la columna url a la tabla products
		Schema::table('products', function($table) {
			$table -> string('url')->after('description');
		});
		
		//añade la columna url a la tabla stores
		Schema::table('stores', function($table) {
			$table -> string('url_seo')->after('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories', function($table) {
			$table -> dropColumn('url');
		});
		
		Schema::table('products', function($table) {
			$table -> dropColumn('url');
		});
		
		Schema::table('stores', function($table) {
			$table -> dropColumn('url_seo');
		});
	}

}