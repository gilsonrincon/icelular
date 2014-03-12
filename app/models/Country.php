<?php

class Country extends Eloquent{
	
	protected $table='countries';
	
	protected $guarded=array('id');
	
	//retorna la lista de estados de un determinado país
	public function states(){
		return $this->hasMany('State','country_id')->get();
	}
}
