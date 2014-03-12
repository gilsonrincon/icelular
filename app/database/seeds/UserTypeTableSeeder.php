<?php

class UserTypeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		UserType::create(array(
			'type'=>'admin',
			'description'=>'Usuario con todos los privilegios administrativos.'
		));
		
		UserType::create(array(
			'type'=>'store',
			'description'=>'Usuario para la gestión de comercios.'
		));
	}

}