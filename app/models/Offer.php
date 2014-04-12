<?php

class Offer extends Eloquent{
		protected $table='offers';

	//Relación de que tiene muchos clicks
	public function clicks()
	{
		return $this->hasMany('OfferClick', 'offer_id');
	}

	//Relacion de que pertenece a una tienda
	public function store()
	{
		return $this->belongsTo('Store', 'store_id');
	}

	//Relación con el producto
	public function product()
	{
		return $this->belongsTo('Product', 'product_id');
	}
}
