<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create(array(
			'password'=>Hash::make('q4c7t208131982'),
			'email'=>'gilson.rincon@gmail.com',
			'user_type'=>1
		));
		
		User::create(array(
			'password'=>Hash::make('q4c7t208131982'),
			'email'=>'gilson.rincon@swm.com.co',
			'user_type'=>2
		));
	}

}