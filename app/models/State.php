<?php

class State extends Eloquent{
	
	protected $table='states';
	
	//Obteine el país de un determinado estado
	public function country(){
		return $this->belongsTo('Country', 'state_id');
	}
}
