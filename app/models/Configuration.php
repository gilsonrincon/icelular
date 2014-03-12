<?php

class Configuration extends Eloquent{
	
	protected $table='configurations';
	
	//retorna el valor de una determinada propiedad
	public static function getValue($name){
		return Configuration::where('name','=',$name)->first()->value;
	}
}
