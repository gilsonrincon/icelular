<?php

use Illuminate\Database\Migrations\Migration;

class RenameToPacketsPurchased extends Migration {

	
	public function up()
	{
		Schema::rename('packeages_purchased', 'packets_purchased');
		Schema::table('packets_purchased', function($table){
			$table->boolean('approved');
		});
	}

	
	public function down()
	{
		Schema::table('packets_purchased', function($table){
			$table->dropColumn('approved');
		});

		Schema::rename('packets_purchased', 'packeages_purchased');
	}

}