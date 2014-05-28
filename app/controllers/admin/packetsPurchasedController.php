<?php
namespace Admin;
use Auth;
use View;
use BaseController;
use Input;
use Configuration;
use PacketPurchased;
use Session;
use Redirect;

class PacketsPurchasedController extends \BaseController {

	public function index()
	{
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='id';
		}
		
		if(Input::has('order_dir')){
			$order_dir=Input::get('order_dir');
		}else{
			$order_dir='asc';
		}
		
		if(Input::has('page')){
			$page=Input::get('page');
		}else{
			$page=1;
		}

		$data['packets'] = PacketPurchased::where('approved', '=', false)
							->orderBy($order_field,$order_dir)
							->paginate(Configuration::where('name','=','page_count')->first()->value);

		$data['order_field'] = $order_field;
		$data['order_dir'] = $order_dir;
		$data['page'] = $page;
		$data['page_name'] = 'packetspurchased';

		return View::make('admin.packetsPurchasedList', $data);
	}

	public function create()
	{
		//
	}

	public function store()
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		$packet = PacketPurchased::find($id);
		$packet->approved = true;
		$packet->store->clics = $packet->store->clics + $packet->packet->clicks;
		$packet->save();
		$packet->store->save();
		return Redirect::to('admin/packetspurchased');
	}

	public function destroy($id)
	{
		//
	}

}