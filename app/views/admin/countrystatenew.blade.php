@extends('admin.layout')

@section('head')
	<title>Administración de Estados</title>
@stop

@section('body')
	<div class="row">
		{{Form::open(array('url' => 'admin/countries'))}}
		{{Form::hidden('country', $country)}}
			<div class="form-group">
				<label class="col-lg-3" for="name">Nombre:</label>
				<div class="col-lg-6">
					<input class="form-control" type="text" id="name" name="name" placeholder="Nombre del estado">
					<p class="help-block">
						Este campo se usa para el nombre del estado
					</p>
				</div>
			</div><br><br><br>
			<div class="form-group">
				{{Form::submit("Guardar",array("class"=>"btn btn-default btn-success"))}}
			</div>
		{{Form::close()}}
	</div>
@stop
