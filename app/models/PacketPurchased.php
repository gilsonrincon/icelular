<?php

class PacketPurchased extends Eloquent{
	
	protected $table='packets_purchased';

	public function store()
	{
		return $this->belongsTo('Store', 'store_id');
	}

	public function packet()
	{
		return $this->belongsTo('ClicksPacket', 'packeage_id');
	}
}
