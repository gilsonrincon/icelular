<?php

class Tag extends Eloquent{
	
	protected $table='tags';
	
	//campos protegidos
	protected $guarded=array('id');

	//muestra una lista de todas las etiquetas usadas, elimina las etiquetas no usadas de la tabla tags
	public static function allUsed(){
		//obtiene todas las tags
		$tags=Tag::all();
		foreach ($tags as $tag) {
			if(ProductTag::where('tag_id','=',$tag->id)->count()<=0){
				$tag->delete();
			}
		}
		return Tag::all();
	}
}
