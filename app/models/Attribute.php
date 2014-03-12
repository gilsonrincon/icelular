<?php

class Attribute extends Eloquent{
	
	protected $table='attributes';
	
	//Retorna el grupo al que pertenece un atributo
	public function group(){
		$this->hasOne('AttributesGgroup');
	}
}
