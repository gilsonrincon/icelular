<?php
namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use ClicksPacket;
use PacketPurchased;
use Session;
use Hash;
use Auth;

class PacketsController extends \BaseController {

	//Lista de paquetes
	public function index()
	{
		if(Input::has('order_field')){
			$order_field = Input::get('order_field');
		}else{
			$order_field = 'id';
		}
		
		if(Input::has('order_dir')){
			$order_dir = Input::get('order_dir');
		}else{
			$order_dir = 'asc';
		}
		
		if(Input::has('page')){
			$page = Input::get('page');
		}else{
			$page =1 ;
		}


		//obtiene la lista de todas los usuarios
		if(ClicksPacket::all()->count() > 0){
			$packeages = ClicksPacket::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$packeages = ClicksPacket::all();
		}

		//parámetros que deben pasarse a la vista
		$data['order_field'] = $order_field;
		$data['order_dir'] = $order_dir;
		$data['packeages'] = $packeages;
		$data['page'] = $page;
		$data['page_name'] = 'packeages';

		return View::make('admin.packetsList', $data);
	}

	//Mostrar el formulario para crear un nuevo usuario
	public function create()
	{
		$data['page_name'] = 'packeages';
		
		return View::make('admin.packetsNew', $data);
	}

	//Guardar una nueva tienda
	public function store()
	{
		$packeage = new ClicksPacket();
		$packeage->name = Input::get('name');
		$packeage->value = Input::get('value');
		$packeage->clicks = Input::get('clicks');
		$packeage->save();
		return Redirect::to('admin/packets');
	}


	public function show($id)
	{
		//
	}

	//Editar un usuario
	public function edit($id)
	{
		
	}

	
	public function update($id)
	{
		
	}

	//Borrar paquetes
	public function destroy()
	{
		$ids = Input::get('ids');
		
		$ids = trim($ids, ",");
		$ids = explode(",", $ids);
		
		foreach($ids as $id){
			$packet = ClicksPacket::find($id);
			$packet->delete();
		}
		
		return Redirect::to('admin/packets');
	}

	//Comprar un paquete
	public function buy($id)
	{
		$store = Auth::user()->store;
		if(count($store) == 0)
			return Redirect::to('/');

		$data['packet'] = ClicksPacket::find($id);
		$data['store'] = $store;

		return View::make('admin.packetBuy', $data);

	}

	//Accion al comprar un paquete por consignación
	public function buyAction($id)
	{
		$store = Auth::user()->store;
		if(count($store) == 0)
			return Redirect::to('/');

		$buy = new PacketPurchased();
		$buy->store_id = Auth::user()->store->id;
		$buy->packeage_id = $id;
		$buy->approved = false;
		$buy->save();

		return Redirect::to('admin/packet/'.$id.'/buy/info');
	}

	public function buyInfo($id)
	{
		$data['packet'] = ClicksPacket::find($id);
		return View::make('admin.packetBuyInfo', $data);
	}
}