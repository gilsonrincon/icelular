<?php

class Product extends Eloquent{

	protected $table='products';
	
	//obtiene una cadena con las tags separadas por (,)
	public function getTagsTxt(){
		$str='';
		$tags=ProductTag::where('product_id','=',$this->id)->get();
		foreach($tags as $tag){
			$tag_=Tag::find($tag['tag_id']);
			//return var_dump($tag_);
			$str.=$tag_['tag'].',';
		}
		
		return $str;
	}
	
	//obtiene ofertas por producto
	public function getOffers(){
		return $this->hasMany('Offer','product_id');
	}
}
