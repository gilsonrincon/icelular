<?php

class Review extends Eloquent{
	
	protected $table='reviews';

	public function complaint()
	{
		return $this->hasOne('Complaint', 'review_id');
	}
}
