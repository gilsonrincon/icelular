<?php

class PacketPurchased extends Eloquent{
	
	protected $table='packeages_purchased';

	public function store()
	{
		return $this->belongsTo('Store', 'store_id');
	}

	public function packeage()
	{
		return $this->belongsTo('ClicksPacket', 'packeage_id');
	}
}
