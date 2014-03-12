<?php

class Store extends Eloquent{
	
	protected $table='stores';
	
	//obtiene las ofertas relacionadas con una tienda
	public function getOffers(){
		return $this->hasMany('Offer','store_id');
	}
}
