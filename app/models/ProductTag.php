<?php

class ProductTag extends Eloquent{
	
	protected $table='product_tags';
	
	//campo protegido
	protected $guarded=array('id');
}
