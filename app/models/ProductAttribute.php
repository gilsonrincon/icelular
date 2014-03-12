<?php

class ProductAttribute extends Eloquent{
	
	protected $table='product_attributes';
	
	protected $guarded=array('id');
	
	
	/**
	* función que retorna el valor de un atributo según el producto indicado
	 * 
	 * @param product_id
	 * @param attribute_id
	 * @return value o una cadena vacía en caso de no existir el attributo
	*/
	public static function getValue($product_id,$attribute_id){
		$val='';
		
		if(DB::table('product_attributes')->where('product_id','=',$product_id)->where('attribute_id','=',$attribute_id)->count()>0){
			$val=ProductAttribute::where('product_id','=',$product_id)->where('attribute_id','=',$attribute_id)->first()->value;
		}
		return $val;
	}
	
}
