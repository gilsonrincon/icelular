<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Complaint;
use Review;
use Mail;
use Cms;

class ComplaintController extends \BaseController {

	//Lista de todos los reclamos
	public function index()
	{
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='status';
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

		$complaints = Complaint::where('id','>','0')->orderBy($order_field,$order_dir)->get();
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['page']=$page;

		$data['complaints'] = $complaints;

		return View::make('admin.complaintsList', $data);
	}

	//hacer un nuevo reclamo
	public function create($id)
	{
		$review = Review::find($id);
		$data['review'] = $review;

		return View::make('admin.complaintNew', $data);
	}


	public function store()
	{
		$complaint = new Complaint();
		$complaint->description = Input::get('description');
		$complaint->review_id = Input::get('id');
		$complaint->status = 'En revisión';

		$complaint->save();

		$data['subject'] = 'Reporte de una calificación';
		$data['user'] = 'Usuario';

		Mail::send('emails.complaint', $data, function($message){
			$message->to('andres.aguilar@swm.com.co', 'Icelular')->subject('Reporte de calificación');
		});

		return Redirect::to('admin/profile');
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
		//
	}

	
	public function destroy($id)
	{
		//
	}

}