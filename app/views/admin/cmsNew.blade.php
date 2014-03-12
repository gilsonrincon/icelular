@extends('admin.layout')

@section("body")
@if(!isset($cms))
<h2>Nuevo contenido</h2>
@else
<h2>Editando contenido: {{$cms["id"]}} - {{$cms["title"]}}</h2>
@endif

@if(isset($cms))
{{Form::open(array('url'=>'admin/cms/'.$cms->id.'/edit', 'class'=>'form-horizontal', "id"=>"editCmsForm"))}}
@else
{{Form::open(array('url'=>'admin/cms/new', 'class'=>'form-horizontal'))}}
@endif
<div class="well well-lg">

	<div class="form-group">
		<label class="col-lg-3" for="title">Título:</label>
		<div class="col-lg-6">
			<input class="form-control" type="text" id="title" name="title" value="@if(isset($cms)){{$cms['title']}}@endif" />
			<p class="help-block">
				Este campo se usa para la etiqueta META TITLE
			</p>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-3" for="url">Url amigable:</label>
		<div class="col-lg-6">
			<input class="form-control" type="text" id="url" name="url" value="@if(isset($cms)){{$cms['url']}}@endif" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3" for="description">Descripción corta:</label>
		<div class="col-lg-6">
			<textarea class="form-control" id="description" name="description">@if(isset($cms)){{$cms['description']}}@endif</textarea>											
			<p class="help-block">
				Este campo se usa para la etiqueta META DESCRIPTION
			</p>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-12" for="content">Contenido:</label>
		<div class="col-lg-12">
			<textarea class="form-control html_editor" id="content" name="content">@if(isset($cms)){{$cms['content']}}@endif</textarea>											
		</div>
	</div>
</div>
<input type="hidden" name="position" id="position" value="0" />
{{Form::submit("Guardar",array("class"=>"btn btn-default btn-success"))}}
{{Form::close()}}
@stop

