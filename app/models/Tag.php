<?php

class Tag extends Eloquent{
	
	protected $table='tags';
	
	//campos protegidos
	protected $guarded=array('id');
}
