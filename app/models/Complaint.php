<?php

class Complaint extends Eloquent{
	
	protected $table='complaints';
	
	//Relación con las calificaciones
	public function review(){
		return $this->belongsTo('Review','review_id')->get();
	}
}
