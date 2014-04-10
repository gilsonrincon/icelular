@extends('admin.layout')

@section("body")
<h2>Editando clics de la tienda: {{$store["id"]}} - {{$store["name"]}}</h2>
	{{Form::open(array('method'=>'post', 'url'=>'admin/availableclicks/update'))}}
		<label class="col-lg-3" for="clics">Numero de clics disponibles:</label>
		{{Form::hidden('id', $store->id)}}
		{{Form::text('clics', $store->clics)}}
		{{Form::submit('Guardar', array('class' => 'btn btn-default btn-success'))}}
	{{Form::close()}}
@stop

