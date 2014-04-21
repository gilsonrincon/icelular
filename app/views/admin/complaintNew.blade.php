@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<h2>Reportar una calificación</h2>
		{{Form::open(array('method'=>'POST', 'url'=>'admin/report'))}}
			<label class="col-lg-3" for="description">Descripción del reporte:</label>
			{{Form::hidden('id', $review->id)}}
			{{Form::textarea('description', '', array('class'=>'form-control'))}}
			{{Form::submit('Reportar', array('class' => 'btn btn-default btn-success'))}}
		{{Form::close()}}
	</div>
@stop
