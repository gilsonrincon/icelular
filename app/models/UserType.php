<?php

class UserType extends Eloquent{
	
	protected $table='user_types';
	
	//campos protegidos
	protected $guarded=array('id');
}
