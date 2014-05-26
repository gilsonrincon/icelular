<?php

class Store extends Eloquent{
	
	protected $table='stores';
	
	//obtiene las ofertas relacionadas con una tienda
	public function getOffers(){
		return $this->hasMany('Offer','store_id');
	}

	//Perteneca a un usuario
	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	//Tiene paquetes de clicks
	public function packeages()
	{
		return $this->hasMany('PacketPurchased', 'store_id');
	}
}
