@extends('admin.layout')

{{-- Si se va a editar un registro --}}

@section('body')
	<h2>Añadir atributos</h2>
	<div class="well well-lg">
		{{Form::open(array('url'=>'admin/attributes/add','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
			
			<div class="form-group">
				<!-- grupo -->
				{{Form::label('attributes_group','Grupo:',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					{{Form::select('attributes_group',$groups)}}
					<p class="help-block">Seleccione el grupo en el que desea añadir atributos</p>
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('attributes',"Puede indicar uno o mas atributos:",array("class"=>"col-lg-4"))}}
				<div class="col-lg-8">
					{{Form::textarea("attributes","")}}
					<p class="help-block">Ingrese los atributos que desee añadir al grupo separándolos con (,)</p>
				</div>
			</div>
			
			<!-- enviar -->
			{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
		{{Form::close()}}
	</div>
@stop

