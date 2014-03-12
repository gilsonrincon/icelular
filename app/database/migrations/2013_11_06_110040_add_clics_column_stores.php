<?php

use Illuminate\Database\Migrations\Migration;

class AddClicsColumnStores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('stores', function($table) {
			$table -> integer('clics')->after('youtube')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('stores', function($table) {
			$table -> dropColumn('clics');
		});
	}

}
