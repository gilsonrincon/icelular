@extends('admin.layout')

@section('body')
	<h2>Comprar un paquete de clicks</h2>
	<div class="well well-lg col-md-12">
		<div class="col-md-12">
			Paquete {{$packet->name}} por {{$packet->clicks}} clicks, tiene un valor de {{$packet->value}}
		</div>

		<img src="{{asset('img/paypal.png')}}" class="col-md-6">
		<div class="col-md-6">
			{{Form::open(['url'=>'admin/packet/'.$packet->id.'/buy'])}}
			{{Form::submit('Compar con consignación bancaria', array('class'=>'btn btn-primary btn-lg btn-block'))}}
			{{Form::close()}}
		</div>
	</div>
@stop

