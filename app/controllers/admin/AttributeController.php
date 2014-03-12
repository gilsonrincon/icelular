<?php
namespace Admin;

Use AttributesGroup;
Use Attribute;
use View;
use BaseController;
use Input;
use Redirect;
Use DB;
Use Configuration;

class AttributeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//obtiene lista de grupos
		$groups=AttributesGroup::all();
		
		//configura el arreglo para enviar info a la plantilla
		$data['page_name']="attributes";
		$data['groups']=$groups;
		
		return View::make('admin.attributesList',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function newGroup()
	{
		$data['page_name']="attributes";
		
		return View::make('admin.attributeGroupNew',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function saveGroup()
	{
		//crea el nuevo grupo
		$group=new AttributesGroup();
		$group['attributes_group']=Input::get('attributes_group');
		$group->save();
		
		//añade los atributos al nuevo grupo (los atributos vienen en una cadena separados por (,))
		$attributes=Input::get('attributes');
		if(strlen($attributes)>0){
			$attributes=trim($attributes,',');
			$attributes=explode(',',$attributes);
			
			foreach($attributes as $attr){
				$attribute=new Attribute();
				$attribute['attribute']=$attr;
				$attribute['attributes_group_id']=$group["id"];
				$attribute->save();
			}
		}
		
		return Redirect::to('admin/attributes');
	}

	/**
	 * Muestra formulario para añadir atributos
	 *
	 * @return Response
	 */
	public function addAttributes()
	{
		$groups=array();
		foreach (AttributesGroup::all() as $gr) {
			$groups=array_add($groups,$gr['id'],$gr['attributes_group']);
		}
		
		$data['page_name']='attributes';
		$data['groups']=$groups;
		return View::make('admin.attributesAdd',$data);
	}

	/**
	 * Guarda los attributos añadidos
	 *
	 * @return Response
	 */
	public function saveAttributes()
	{
		//añade los atributos al nuevo grupo (los atributos vienen en una cadena separados por (,))
		$attributes=Input::get('attributes');
		if(strlen($attributes)>0){
			$attributes=trim($attributes,',');
			$attributes=explode(',',$attributes);
			
			foreach($attributes as $attr){
				$attribute=new Attribute();
				$attribute['attribute']=$attr;
				$attribute['attributes_group_id']=Input::get('attributes_group');
				$attribute->save();
			}
		}
		
		return Redirect::to('admin/attributes');
	}

	/**
	 * Actualiza el nombre de un grupo de atributos
	 *
	 * @return Response
	 */
	public function editGroup()
	{
		$id=Input::get('id');
		$group = AttributesGroup::find($id);
		$group['attributes_group']=Input::get('attributes_group');
		$group->save();
		
		return Redirect::to('admin/attributes');
	}

	/**
	 * Elimina un grupo de atributos
	 *
	 * @return Response
	 */
	public function deleteGroup()
	{
		$id=Input::get('id');
		$group = AttributesGroup::find($id);
		$group->delete();
		
		return Redirect::to('admin/attributes');
	}

	/**
	 * Actualiza el nombre de un atributo
	 *
	 * @return Response
	 */
	public function editAttr()
	{
		$id=Input::get('id');
		$group = Attribute::find($id);
		$group['attribute']=Input::get('attribute');
		$group->save();
		
		return Redirect::to('admin/attributes');
	}
	
	/**
	 * Elimina un atributo
	 *
	 * @return Response
	 */
	public function deleteAttr()
	{
		$id=Input::get('id');
		$group = Attribute::find($id);
		$group->delete();
		
		return Redirect::to('admin/attributes');
	}
}