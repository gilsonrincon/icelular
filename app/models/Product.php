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

	//Relación con los atributos
	public function attributes()
	{
		return $this->hasMany('ProductAttribute', 'product_id');
	}

	//Relacion con la categoria
	public function categories()
	{
		return $this->hasMany('ProductCategory', 'product_id');
	}

	//Relación con las imagenes
	public function images()
	{
		return $this->hasMany('ProductImage', 'product_id');
	}

	//Relacion con las ofertas
	public function offers()
	{
		return $this->hasMany('Offer', 'product_id');
	}
}
