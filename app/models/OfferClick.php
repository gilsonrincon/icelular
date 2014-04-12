<?php

class OfferClick extends Eloquent{
		protected $table='offers_clicks';
		
		protected $guarded=array('id');

	//Relación de que pertenece a una oferta
	public function offer()
	{
		return $this->belongsTo('Offer', 'offer_id');
	}
}
