<?php

class AttributesGroup extends Eloquent{
	
	//retorna lista de attributos por grupo
	public function attributes(){
		return $this->hasMany('Attribute','attributes_group_id');
	}
}
